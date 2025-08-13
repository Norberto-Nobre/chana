<?php

namespace App\Http\Controllers;

use App\Contracts\VehicleModelRepositoryInterface;
use Illuminate\Http\Request;
use App\Contracts\VehicleRepositoryInterface;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
     protected $vehicleModelRepository;
    protected $vehicleRepository;

    public function __construct(VehicleRepositoryInterface $vehicleRepository, VehicleModelRepositoryInterface $vehicleModelRepository)
    {
        $this->vehicleModelRepository = $vehicleModelRepository;
        $this->vehicleRepository = $vehicleRepository;
    }

    public function detalhes(Request $request)
    {
        $dados = $request->validate([
            'pickup_location' => 'required|string|max:255',
            'dropoff_location' => 'required|string|max:255',
            'pickup_date'      => 'required|date',
            'pickup_time'      => 'required',
            'dropoff_date'     => 'required|date|after_or_equal:pickup_date',
            'dropoff_time'     => 'required',
            'vehicle_id'       => 'required|integer|exists:vehicles,id',
        ]);

         // 2. Se precisar filtrar ou ajustar dados (opcional)
        $dados['pickup_location'] = trim($dados['pickup_location']);
        $dados['dropoff_location'] = trim($dados['dropoff_location']);

        $vehicleId = $request->get('vehicle_id');

        // Buscar dados do carro pelo ID
        $vehicle = $this->vehicleRepository->find($vehicleId);

        if (!$vehicle) {
            return redirect()->back()->with('error', 'Carro não encontrado.');
        }

        return view('reserva-detalhes', compact('vehicle', 'dados'));
    }

    public function confirmar(Request $request)
{
    $request->validate([
        'vehicle_id'      => 'required|exists:vehicles,id',
        'name'            => 'required|string|max:255',
        'email'           => 'required|email|max:255',
        'phone'           => 'required|string|max:20',
        'address'         => 'required|string|max:500',
        'date_of_birth'   => 'required|date|before:today',
        'gender'          => 'nullable|string|in:masculino,feminino,outro',
        'start_date'      => 'required|date|after_or_equal:today',
        'end_date'        => 'required|date|after:start_date',
    ]);

    DB::beginTransaction();

    try {
        // Verificar disponibilidade do veículo
        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        
        $conflictingBooking = Booking::where('vehicle_id', $request->vehicle_id)
            ->where('status', '!=', Booking::STATUS_CANCELLED)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                      ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                      ->orWhere(function ($subQuery) use ($request) {
                          $subQuery->where('start_date', '<=', $request->start_date)
                                   ->where('end_date', '>=', $request->end_date);
                      });
            })
            ->exists();

        if ($conflictingBooking) {
            throw new \Exception('O veículo não está disponível no período selecionado.');
        }

        // Verificar se cliente já existe pelo email
        $customer = Customer::where('email', $request->email)->first();
        
        if (!$customer) {
            // Criar novo cliente
            $customer = Customer::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'gender'        => $request->gender,
                'phone'         => $request->phone,
                'address'       => $request->address,
                'date_of_birth' => $request->date_of_birth,
            ]);
        }

        // Calcular valores da reserva
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $startDate->diffInDays($endDate);
        $days = max($days, 1); // Mínimo 1 dia
        
        $dailyRate = $vehicle->daily_rate ?? 0;
        $subtotalAmount = $dailyRate * $days;
        
        $taxPercentage = config('booking.tax_percentage', 0); // Ex: 18% de imposto
        $taxAmount = ($subtotalAmount * $taxPercentage) / 100;
        
        $discountPercentage = 0; // Pode ser calculado baseado em regras de negócio
        $discountAmount = ($subtotalAmount * $discountPercentage) / 100;
        
        $totalAmount = $subtotalAmount + $taxAmount - $discountAmount;

        // Criar a reserva
        $booking = Booking::create([
            'customer_id'         => $customer->id,
            'vehicle_id'          => $request->vehicle_id,
            'start_date'          => $request->start_date,
            'end_date'            => $request->end_date,
            'pickup_date'         => $request->start_date,
            'return_date'         => $request->end_date,
            'status'              => Booking::STATUS_PENDING,
            'subtotal_amount'     => $subtotalAmount,
            'tax_amount'          => $taxAmount,
            'discount_amount'     => $discountAmount,
            'total_amount'        => $totalAmount,
            'daily_rate'          => $dailyRate,
            'days'                => $days,
            'tax_percentage'      => $taxPercentage,
            'discount_percentage' => $discountPercentage,
        ]);

        DB::commit();

        return redirect()->route('reserva.sucesso', ['booking' => $booking->id])
            ->with('success', 'Reserva criada com sucesso!');
            
    } catch (\Exception $e) {
        DB::rollBack();
        
        return back()
            ->withInput()
            ->with('error', 'Erro ao criar reserva: ' . $e->getMessage());
    }
}

public function success(Request $request)
{
    $bookingId = $request->get('booking');
    
    if (!$bookingId) {
        return redirect()->route('front.index')->with('error', 'Reserva não encontrada.');
    }

    $booking = Booking::find($bookingId);
    
    if (!$booking) {
        return redirect()->route('front.index')->with('error', 'Reserva não encontrada.');
    }

    return view('reserva-sucesso', compact('booking'));
}
}
