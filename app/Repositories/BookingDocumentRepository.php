<?php

namespace App\Repositories;

use App\Contracts\BookingDocumentRepositoryInterface;
use App\Models\BookingDocument;
use Illuminate\Database\Eloquent\Collection;

class BookingDocumentRepository implements BookingDocumentRepositoryInterface
{
    public function getByBooking(int $bookingId): Collection
    {
        return BookingDocument::where('booking_id', $bookingId)
                             ->orderBy('uploaded_at', 'desc')
                             ->get();
    }

    public function find(int $id): ?BookingDocument
    {
        return BookingDocument::find($id);
    }

    public function create(array $data): BookingDocument
    {
        $data['uploaded_at'] = now();
        return BookingDocument::create($data);
    }

    public function delete(int $id): bool
    {
        $document = BookingDocument::find($id);
        return $document ? $document->delete() : false;
    }

    public function deleteByBooking(int $bookingId): bool
    {
        return BookingDocument::where('booking_id', $bookingId)->delete();
    }
}