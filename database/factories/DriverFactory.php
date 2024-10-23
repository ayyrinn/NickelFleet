<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), 
            'license_number' => str_pad(random_int(0, 9999999999999999), 16, '0', STR_PAD_LEFT), 
            'phone_number' => fake()->phoneNumber(),
        ];
    }
}
