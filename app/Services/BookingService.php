<?php

namespace App\Services;

use App\Contracts\BookingRepositoryInterface;
use App\Contracts\VehicleRepositoryInterface;
use App\Models\Booking;
use App\Models\Vehicle;
use Carbon\Carbon;

class BookingService
{
    public function __construct(
        private BookingRepositoryInterface $bookingRepository,
        private VehicleRepositoryInterface $vehicleRepository
    ) {}

    public function createBooking(array $data): Booking
    {
        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);
        $days = $startDate->diffInDays($endDate) ?: 1;

        $vehicle = $this->vehicleRepository->find($data['vehicle_id']);
        
        if (!$vehicle->isAvailable($data['start_date'], $data['end_date'])) {
            throw new \Exception('Veículo não disponível no período selecionado.');
        }

        $dailyRate = $vehicle->model->price_per_day;
        $subtotal = $dailyRate * $days;
        
        // Aplicar desconto se fornecido
        $discountPercentage = $data['discount_percentage'] ?? 0;
        $discountAmount = ($subtotal * $discountPercentage) / 100;
        
        // Calcular subtotal após desconto
        $subtotalAfterDiscount = $subtotal - $discountAmount;
        
        // Aplicar taxa se fornecida
        $taxPercentage = $data['tax_percentage'] ?? 0;
        $taxAmount = ($subtotalAfterDiscount * $taxPercentage) / 100;
        
        // Calcular total final
        $totalAmount = $subtotalAfterDiscount + $taxAmount;

        $bookingData = array_merge($data, [
            'daily_rate' => $dailyRate,
            'days' => $days,
            'subtotal_amount' => $subtotal,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
            'tax_percentage' => $taxPercentage,
            'discount_percentage' => $discountPercentage,
            'status' => Booking::STATUS_PENDING
        ]);

        return $this->bookingRepository->create($bookingData);
    }

    public function approveBooking(int $bookingId): bool
    {
        $booking = $this->bookingRepository->find($bookingId);
        
        if (!$booking || $booking->status !== Booking::STATUS_PENDING) {
            return false;
        }

        // Atualiza status da reserva
        $this->bookingRepository->update($bookingId, [
            'status' => Booking::STATUS_APPROVED
        ]);

        // Marca veículo como alugado
        $this->vehicleRepository->updateStatus($booking->vehicle_id, Vehicle::STATUS_RENTED);

        return true;
    }

    public function returnVehicle(int $bookingId): bool
    {
        $booking = $this->bookingRepository->find($bookingId);
        
        if (!$booking || !in_array($booking->status, [Booking::STATUS_APPROVED, Booking::STATUS_ACTIVE])) {
            return false;
        }

        // Atualiza status da reserva
        $this->bookingRepository->update($bookingId, [
            'status' => Booking::STATUS_RETURNED,
            'return_date' => now()
        ]);

        // Marca veículo como disponível
        $this->vehicleRepository->updateStatus($booking->vehicle_id, Vehicle::STATUS_AVAILABLE);

        return true;
    }

    public function processExpiredBookings(): int
    {
        $expiredBookings = $this->bookingRepository->getExpiredBookings();
        $count = 0;

        foreach ($expiredBookings as $booking) {
            $this->bookingRepository->update($booking->id, [
                'status' => Booking::STATUS_EXPIRED
            ]);

            $this->vehicleRepository->updateStatus($booking->vehicle_id, Vehicle::STATUS_AVAILABLE);
            $count++;
        }

        return $count;
    }
}