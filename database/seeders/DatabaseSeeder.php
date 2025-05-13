<?php

namespace Database\Seeders;

use App\Models\MessageManagement;
use App\Models\Subscription_package;
use App\Models\Tenant;
use App\Models\TenantSubscriptionLog;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $tenants[] = Tenant::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $tenants[] = Tenant::factory(5)->create();


//dd($tenants);
        $packages = Subscription_package::insert([
            [
                'name' => 'bronze',
                'description' => 'Basic plan suitable for starters.',
                'price' => 100.00,
                'message_balance' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'silver',
                'description' => 'Affordable plan with additional features.',
                'price' => 300.00,
                'message_balance' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'gold',
                'description' => 'Advanced plan with premium benefits.',
                'price' => 500.00,
                'message_balance' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'platinum',
                'description' => 'Premium plan with all-inclusive features.',
                'price' => 1000.00,
                'message_balance' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

//        dd(Subscription_package::inRandomOrder()->first());


        foreach (Tenant::all() as $tenant) {
            $package = Subscription_package::inRandomOrder()->first();
//            dd($package->id, $tenant->id);
            TenantSubscriptionLog::factory()->create([
                'tenant_id' => $tenant->id,
                'subscription_package_id' => $package->id,
                'message_balance' => $package->message_balance,
            ]);
        }
//        dd(Tenant::all()->first()->subscriptionLogs);

        foreach (Tenant::all()->first()->subscriptionLogs as $subscriptionLog) {

            $MessageManagement = MessageManagement::factory()->create([
                'tenant_subscription_log_id' => $subscriptionLog->id,
                'message_quota' => $subscriptionLog->message_balance - 250,
            ]);

            $subscriptionLog->message_balance = $subscriptionLog->message_balance - $MessageManagement->message_quota;
        }



    }
}
