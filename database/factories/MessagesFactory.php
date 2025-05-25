<?php

namespace Database\Factories;

use App\Models\token;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\messages>
 */
class MessagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'message' => $this->faker->sentence(),
            'token_id' => token::factory(),
            'sending_number' => $this->faker->randomNumber(),
            'receiving_number' => $this->faker->randomNumber(),

        ];
    }
}
