<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\BookingContract;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookingContractFactory extends Factory
{
    protected $model = BookingContract::class;

    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'contract_number' => strtoupper(Str::random(10)),
            'file_path' => 'contracts/' . Str::uuid() . '.pdf',
            'generated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'terms_conditions' => $this->faker->optional()->paragraphs(5, true),
        ];
    }
}
