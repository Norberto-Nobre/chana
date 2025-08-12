<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'gender' => $this->faker->optional()->randomElement(['M', 'F']),
            'email_verified_at' => $this->faker->optional()->dateTime(),
            'password' => Hash::make('password'), // senha padrão
            'phone' => $this->faker->optional()->phoneNumber(),
            'address' => $this->faker->optional()->address(),
            'date_of_birth' => $this->faker->optional()->date('Y-m-d', '-18 years'),
            'license_number' => $this->faker->optional()->bothify('LIC#######'),
            'license_expiry' => $this->faker->optional()->dateTimeBetween('now', '+10 years'),
            'remember_token' => Str::random(10),
        ];
    }
}
