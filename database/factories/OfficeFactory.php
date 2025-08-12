<?php

namespace Database\Factories;

use App\Models\Office;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfficeFactory extends Factory
{
    protected $model = Office::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Office',
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'phone' => $this->faker->optional()->phoneNumber,
            'email' => $this->faker->optional()->companyEmail,
            'latitude' => $this->faker->optional()->latitude(-90, 90),
            'longitude' => $this->faker->optional()->longitude(-180, 180),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
