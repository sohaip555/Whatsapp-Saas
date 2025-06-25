<?php

namespace Database\Seeders;

use App\Models\SubscriptionPackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySubscriptionLog extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 5; $i++) {
            $package = SubscriptionPackage::inRandomOrder()->first();
            \App\Models\CompanySubscriptionLog::factory()->create([
                'subscription_package_id' => $package->id,
                'message_balance' => $package->message_balance,
            ]);
        }


    }
}
