<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word, // ou ->words(2, true) para mais de uma palavra
            'description' => $this->faker->sentence(10), // texto opcional
            'is_active' => $this->faker->boolean(90), // 90% de chance de vir como true
        ];
    }
}
