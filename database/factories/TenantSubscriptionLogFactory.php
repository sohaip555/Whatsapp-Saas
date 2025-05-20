<?php

namespace Database\Factories;

use App\Models\SubscriptionPackage;
use App\Models\Tenant;
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
            'name' => $this->faker->name(),
            'tenant_id' => Tenant::factory(),
            'subscription_package_id' => SubscriptionPackage::factory(),
            'message_balance' => $this->faker->numberBetween(50, 5000),
        ];
    }
}
