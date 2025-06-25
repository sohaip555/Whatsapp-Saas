<?php

namespace Database\Factories;

use App\Models\SubscriptionPackage;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanySubscriptionLog>
 */
class CompanySubscriptionLogFactory extends Factory
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
            'company_id' => Company::factory(),
            'subscription_package_id' => SubscriptionPackage::factory(),
            'message_balance' => $this->faker->numberBetween(50, 5000),
        ];
    }
}
