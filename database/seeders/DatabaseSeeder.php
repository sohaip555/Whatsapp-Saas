<?php

namespace Database\Seeders;

use App\Models\messages;
use App\Models\token;
use App\Models\SubscriptionPackage;
use App\Models\Tenant;
use App\Models\TenantSubscriptionLog;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

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

//        $tenants[] = Tenant::factory(5)->create();


//dd($tenants);
        $packages = SubscriptionPackage::insert([
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
            $package = SubscriptionPackage::inRandomOrder()->first();
            TenantSubscriptionLog::factory()->create([
                'tenant_id' => $tenant->id,
                'subscription_package_id' => $package->id,
                'message_balance' => $package->message_balance,
            ]);
        }

        foreach (Tenant::all() as $tenant) {
            $package = SubscriptionPackage::inRandomOrder()->first();
            TenantSubscriptionLog::factory()->create([
                'tenant_id' => $tenant->id,
                'subscription_package_id' => $package->id,
                'message_balance' => $package->message_balance,
            ]);
        }

        foreach (Tenant::all() as $tenant) {
            $package = SubscriptionPackage::inRandomOrder()->first();
            TenantSubscriptionLog::factory()->create([
                'tenant_id' => $tenant->id,
                'subscription_package_id' => $package->id,
                'message_balance' => $package->message_balance,
            ]);
        }


//        dd(Tenant::all()->first()->tenantSubscriptionLog);

        foreach (Tenant::all()->first()->subscriptionLogs as $subscriptionLog) {

            $tokens = token::factory()->create([
                'tenant_subscription_log_id' => $subscriptionLog->id,
                'message_quota' => $subscriptionLog->message_balance - 80,
            ]);

            $subscriptionLog->message_balance = $subscriptionLog->message_balance - $tokens->message_quota;
            $subscriptionLog->save();

        }

        foreach (token::all() as $token) {
            messages::factory()->create([
                'created_at' => now()->subDays(rand(0, 5)),
                'token_id' => $token->id,
            ]);
        }



    }
}
