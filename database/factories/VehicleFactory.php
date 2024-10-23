<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'type' => fake()->randomElement(['orang', 'barang']), 
            'plate_number' => strtoupper(fake()->bothify('?? #### ??')), 
            'fuel_type' => fake()->randomElement(['Dexlite', 'Solar', 'Pertalite']), 
            'is_rented' => fake()->boolean(),
        ];
    }
}
