<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Booking;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ApprovalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(), 
            'approved_by' => User::factory(), 
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']), 
            'notes' => fake()->sentence(), 
            'approval_level' => fake()->numberBetween(1, 2),
        ];
    }
}
