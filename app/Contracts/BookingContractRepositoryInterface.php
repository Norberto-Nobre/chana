<?php

namespace App\Contracts;

use App\Models\BookingContract;

interface BookingContractRepositoryInterface
{
    public function findByBooking(int $bookingId): ?BookingContract;
    public function find(int $id): ?BookingContract;
    public function create(array $data): BookingContract;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}