<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(4),
            'price' => $this->faker->numberBetween(50, 500),
            'discount' => $this->faker->numberBetween(1, 20),
            'status' => $this->faker->numberBetween(0, 1),
        ];
    }
}
