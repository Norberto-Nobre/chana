<?php

namespace App\Services;

use App\Contracts\BookingDocumentRepositoryInterface;
use App\Models\BookingDocument;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class BookingDocumentService
{
    public function __construct(
        private BookingDocumentRepositoryInterface $documentRepository
    ) {}

    public function getBookingDocuments(int $bookingId): Collection
    {
        return $this->documentRepository->getByBooking($bookingId);
    }

    public function findDocument(int $id): ?BookingDocument
    {
        return $this->documentRepository->find($id);
    }

    public function uploadDocument(int $bookingId, $file, string $type): BookingDocument
    {
        $filePath = $file->store("booking-documents/{$bookingId}", 'public');

        $data = [
            'booking_id' => $bookingId,
            'document_type' => $type,
            'file_path' => $filePath,
            'original_name' => $file->getClientOriginalName(),
            'file_size' => $file->getSize()
        ];

        return $this->documentRepository->create($data);
    }

    public function deleteDocument(int $id): bool
    {
        $document = $this->documentRepository->find($id);
        
        if (!$document) {
            return false;
        }

        // Delete file from storage
        Storage::disk('public')->delete($document->file_path);

        return $this->documentRepository->delete($id);
    }

    public function deleteBookingDocuments(int $bookingId): bool
    {
        $documents = $this->documentRepository->getByBooking($bookingId);
        
        // Delete all files
        foreach ($documents as $document) {
            Storage::disk('public')->delete($document->file_path);
        }

        return $this->documentRepository->deleteByBooking($bookingId);
    }

    public function getDocumentPath(BookingDocument $document): string
    {
        return Storage::disk('public')->url($document->file_path);
    }
}