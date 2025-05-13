<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MessageManagement>
 */
class MessageManagementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'token' => 'DHkWCvz7IEjTcxIhZgf0WmGjsXnELq84jEREIuF0t2WxPf0SRvAcOPSnN2CrC1FI', // Unique token for the record
            'message_quota' => $this->faker->numberBetween(1, 1000), // Random message quota between 1 and 1000
        ];
    }
}
