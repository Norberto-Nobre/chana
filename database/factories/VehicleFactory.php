<?php

namespace Database\Factories;

use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        return [
            'vehicle_model_id' => VehicleModel::factory(), // Cria um modelo de veículo automaticamente
            'license_plate' => strtoupper($this->faker->bothify('???-####')), // Ex: ABC-1234
            'chassis_number' => strtoupper($this->faker->regexify('[A-Z0-9]{17}')), // 17 chars VIN-like
            'color' => $this->faker->safeColorName,
            'mileage' => $this->faker->numberBetween(0, 200000),
            'status' => $this->faker->randomElement(['available', 'rented', 'maintenance', 'inactive']),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
