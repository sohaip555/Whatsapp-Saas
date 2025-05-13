<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TenantSubscriptionLog>
 */
class TenantSubscriptionLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
//            'tenant_id' => $this->faker->randomDigitNotNull(),
//            'subscription_package_id' => $this->faker->randomDigitNotNull(),
//            'message_balance' => $this->faker->numberBetween(50, 5000),
        ];
    }
}
