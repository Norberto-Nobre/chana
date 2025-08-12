<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Office;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        // Data inicial (entre hoje e 30 dias no futuro)
        $startDate = Carbon::now()->addDays($this->faker->numberBetween(0, 30));
        // Data final (até 7 dias após a inicial)
        $endDate = (clone $startDate)->addDays($this->faker->numberBetween(1, 7));

        // Número de dias de aluguel
        $days = $endDate->diffInDays($startDate);

        // Valores
        $dailyRate = $this->faker->randomFloat(2, 20, 300);
        $subtotal = $dailyRate * $days;
        $taxPercentage = $this->faker->randomFloat(2, 0, 15);
        $taxAmount = ($subtotal * $taxPercentage) / 100;
        $discountPercentage = $this->faker->randomFloat(2, 0, 10);
        $discountAmount = ($subtotal * $discountPercentage) / 100;
        $totalAmount = $subtotal + $taxAmount - $discountAmount;

        return [
            'customer_id' => Customer::factory(),
            'vehicle_id' => Vehicle::factory(),
            'pickup_office_id' => Office::factory(),
            'return_office_id' => Office::factory(),
            'days' => 5,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'daily_rate' => $dailyRate,
            'subtotal_amount' => $subtotal,
            'tax_percentage' => $taxPercentage,
            'tax_amount' => $taxAmount,
            'discount_percentage' => $discountPercentage,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
            'status' => $this->faker->randomElement(['pending', 'approved', 'active', 'returned', 'cancelled', 'expired']),
            'notes' => $this->faker->sentence(),
        ];
    }
}
