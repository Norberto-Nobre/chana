<?php

namespace App\Services;

use App\Contracts\ContractServiceInterface;
use App\Models\Booking;
use App\Models\BookingContract;
use App\Models\Contract;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ContractService implements ContractServiceInterface
{
    public function generateContract(Booking $booking): BookingContract
    {
        $contract = BookingContract::create([
            'booking_id' => $booking->id,
            'terms_conditions' => $this->getDefaultTerms()
        ]);

        $pdf = $this->generatePdf($booking, $contract);
        $filePath = "contracts/booking_{$booking->id}_{$contract->contract_number}.pdf";
        
        Storage::disk('public')->put($filePath, $pdf->output());
        
        $contract->update(['file_path' => $filePath]);

        return $contract;
    }

    public function getContractPath(BookingContract $contract): string
    {
        return Storage::disk('public')->url($contract->file_path);
    }

    private function generatePdf(Booking $booking, BookingContract $contract)
    {
        $data = [
            'booking' => $booking,
            'contract' => $contract,
            'customer' => $booking->customer,
            'vehicle' => $booking->vehicle,
            'model' => $booking->vehicle->model,
            'brand' => $booking->vehicle->model->brand
        ];

        return Pdf::loadView('contracts.template', $data);
    }

    private function getDefaultTerms(): string
    {
        return "
        TERMOS E CONDIÇÕES DE ALUGUEL DE VEÍCULOS

        1. O cliente deve apresentar documento de identificação válido e carteira de motorista.
        2. O veículo deve ser devolvido nas mesmas condições em que foi retirado.
        3. O cliente é responsável por danos causados ao veículo durante o período de aluguel.
        4. É proibido fumar no interior do veículo.
        5. O cliente deve respeitar todas as leis de trânsito.
        6. Em caso de acidente, o cliente deve comunicar imediatamente à empresa.
        7. O combustível deve ser reposto pelo cliente antes da devolução.
        8. Atraso na devolução resultará em cobrança de taxa adicional.
        9. O cliente autoriza débito em cartão de crédito para cobrir danos ou multas.
        10. Este contrato é regido pelas leis em vigor.
        ";
    }
}
