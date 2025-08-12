<?php

namespace App\Contracts;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;

interface BookingRepositoryInterface
{
    public function create(array $data): Booking;
    public function update(int $id, array $data): bool;
    public function find(int $id): ?Booking;
    public function findByCode(string $code): ?Booking;
    public function getExpiredBookings(): Collection;
    public function getPendingBookings(): Collection;
    public function getCustomerBookings(int $customerId): Collection;
}