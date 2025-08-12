<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookingDocumentRepositoryInterface;

class ReservaController extends Controller
{
    public function detalhes(Request $request)
    {
        // Recebe dados da etapa anterior
        $dadosReserva = $request->only([
            'pickup_location', 'dropoff_location',
            'pickup_date', 'pickup_time',
            'dropoff_date', 'dropoff_time'
        ]);

        return view('pages.reserva-detalhes', compact('dadosReserva'));
    }

    public function store(Request $request, BookingDocumentRepositoryInterface $bookingDocumentRepository)
    {
        $validated = $request->validate([
            'pickup_location' => 'required',
            'dropoff_location' => 'required',
            'pickup_date' => 'required|date',
            'pickup_time' => 'required',
            'dropoff_date' => 'required|date',
            'dropoff_time' => 'required',
            'name' => 'required|string',
            'gender' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'birth_date' => 'required|date',
            'address' => 'required|string'
        ]);

        $bookingDocumentRepository->create($validated);

        return redirect()->route('home')->with('success', 'Reserva realizada com sucesso!');
    }
}
