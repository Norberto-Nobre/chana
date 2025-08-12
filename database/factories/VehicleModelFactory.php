<?php

namespace Database\Factories;

use App\Models\VehicleModel;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleModelFactory extends Factory
{
    protected $model = VehicleModel::class;

    public function definition(): array
    {
        return [
            'brand_id' => Brand::factory(), // ou use um ID existente
            'category_id' => Category::factory(), // ou use um ID existente
            'name' => $this->faker->words(2, true), // Ex: "Corolla X"
            'year' => $this->faker->numberBetween(2015, date('Y')),
            'fuel_type' => $this->faker->randomElement(['gasoline', 'diesel', 'electric', 'hybrid']),
            'transmission' => $this->faker->randomElement(['manual', 'automatic']),
            'seats' => $this->faker->numberBetween(2, 7),
            'doors' => $this->faker->numberBetween(2, 5),
            'price_per_day' => $this->faker->randomFloat(2, 30, 300),
            'image' => $this->faker->imageUrl(640, 480, 'transport', true, 'car'),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
