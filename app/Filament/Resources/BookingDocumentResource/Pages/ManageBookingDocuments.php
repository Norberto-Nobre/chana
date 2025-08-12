<?php

namespace App\Filament\Resources\BookingDocumentResource\Pages;

use App\Filament\Resources\BookingDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBookingDocuments extends ManageRecords
{
    protected static string $resource = BookingDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
