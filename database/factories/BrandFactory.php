<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company, // Nome fictício da marca
            'logo' => $this->faker->imageUrl(200, 200, 'business', true, 'logo'), // URL fake para o logo
            'is_active' => $this->faker->boolean(90), // 90% de chance de ser true
        ];
    }
}
