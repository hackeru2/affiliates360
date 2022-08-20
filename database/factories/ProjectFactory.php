<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => "mixed"])] public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Admin','UI' ,'API','B2C','Portfolio','LandingPage']),
        ];
    }
}
