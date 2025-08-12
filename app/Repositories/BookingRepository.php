<?php

namespace App\Repositories;

use App\Contracts\BookingRepositoryInterface;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;

class BookingRepository implements BookingRepositoryInterface
{
    public function create(array $data): Booking
    {
        return Booking::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return Booking::where('id', $id)->update($data);
    }

    public function find(int $id): ?Booking
    {
        return Booking::with(['customer', 'vehicle.model.brand', 'pickupOffice', 'returnOffice'])
                     ->find($id);
    }

    public function findByCode(string $code): ?Booking
    {
        return Booking::with(['customer', 'vehicle.model.brand', 'pickupOffice', 'returnOffice'])
                     ->where('booking_code', $code)
                     ->first();
    }

    public function getExpiredBookings(): Collection
    {
        return Booking::where('status', Booking::STATUS_APPROVED)
                     ->where('start_date', '<', now()->subHours(2))
                     ->get();
    }

    public function getPendingBookings(): Collection
    {
        return Booking::with(['customer', 'vehicle.model.brand'])
                     ->where('status', Booking::STATUS_PENDING)
                     ->orderBy('created_at', 'desc')
                     ->get();
    }

    public function getCustomerBookings(int $customerId): Collection
    {
        return Booking::with(['vehicle.model.brand', 'pickupOffice', 'returnOffice'])
                     ->where('customer_id', $customerId)
                     ->orderBy('created_at', 'desc')
                     ->get();
    }
}