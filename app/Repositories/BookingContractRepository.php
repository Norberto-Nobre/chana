<?php

namespace App\Repositories;

use App\Contracts\BookingContractRepositoryInterface;
use App\Models\BookingContract;

class BookingContractRepository implements BookingContractRepositoryInterface
{
    public function findByBooking(int $bookingId): ?BookingContract
    {
        return BookingContract::where('booking_id', $bookingId)->first();
    }

    public function find(int $id): ?BookingContract
    {
        return BookingContract::find($id);
    }

    public function create(array $data): BookingContract
    {
        return BookingContract::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return BookingContract::where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        $contract = BookingContract::find($id);
        return $contract ? $contract->delete() : false;
    }
}