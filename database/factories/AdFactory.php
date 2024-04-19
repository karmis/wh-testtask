<?php

namespace Database\Factories;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(200),
            'price' => fake()->randomFloat(2, 10, 100),
            'description' => fake()->realText(1000),
            'photo' => fake()->imageUrl(),
            'photos' => [
                fake()->imageUrl(),
                fake()->imageUrl(),
                fake()->imageUrl()
            ],
        ];
    }
}
