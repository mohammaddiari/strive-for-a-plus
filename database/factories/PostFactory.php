<?php

namespace Database\Factories;

use App\Enums\Level;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'subject' => fake()->sentence(),
            'price' => fake()->randomFloat(2),
            'level' => fake()->randomElement(Level::cases()),
            'capacity' => fake()->numberBetween(1, 500),
        ];
    }
}
