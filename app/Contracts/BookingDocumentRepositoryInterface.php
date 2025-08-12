<?php

namespace App\Contracts;

use App\Models\BookingDocument;
use Illuminate\Database\Eloquent\Collection;

interface BookingDocumentRepositoryInterface
{
    public function getByBooking(int $bookingId): Collection;
    public function find(int $id): ?BookingDocument;
    public function create(array $data): BookingDocument;
    public function delete(int $id): bool;
    public function deleteByBooking(int $bookingId): bool;
}