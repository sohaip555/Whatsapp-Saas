<?php

namespace Database\Seeders;

use App\Models\SubscriptionPackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSubscriptionLog extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $package = SubscriptionPackage::inRandomOrder()->first();
        \App\Models\TenantSubscriptionLog::factory()->create([
            'subscription_package_id' => $package->id,
            'message_balance' => $package->message_balance,
        ]);
    }
}
