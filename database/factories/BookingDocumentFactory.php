<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\BookingDocument;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookingDocumentFactory extends Factory
{
    protected $model = BookingDocument::class;

    public function definition(): array
    {
        $documentTypes = ['identity_document', 'passport', 'driving_license', 'other'];

        return [
            'booking_id' => Booking::factory(),
            'document_type' => $this->faker->randomElement($documentTypes),
            'file_path' => 'documents/' . Str::uuid() . '.pdf',
            'original_name' => $this->faker->word() . '.pdf',
            'file_size' => $this->faker->numberBetween(10000, 500000), // bytes
            'uploaded_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
