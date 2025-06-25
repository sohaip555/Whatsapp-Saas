<?php

namespace Database\Seeders;

use App\Models\messages;
use App\Models\token;
use App\Models\SubscriptionPackage;
use App\Models\Company;
use App\Models\CompanySubscriptionLog;
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
        $company = Company::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'company_id' => $company->id,
            'type' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Test2',
            'email' => 'test2@example.com',
            'password' => bcrypt('password'),
            'company_id' => $company->id,
            'type' => 'company',
        ]);


        $companies[] = Company::factory(5)->create();


//dd($companies);
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


        for ($i = 0; $i < 10; $i++){
            $package = SubscriptionPackage::inRandomOrder()->first();
            CompanySubscriptionLog::factory()->create([
                'company_id' => $company->id,
                'subscription_package_id' => $package->id,
                'message_balance' => $package->message_balance,
            ]);
        }


//        dd(Company::all()->first()->tenantSubscriptionLog);

        foreach ($company->subscriptionLogs as $subscriptionLog) {

            $tokens = token::factory()->create([
                'company_subscription_log_id' => $subscriptionLog->id,
                'message_quota' => $subscriptionLog->message_balance - 80,
                'company_id' => $company->id,
            ]);

            $subscriptionLog->message_balance = $subscriptionLog->message_balance - $tokens->message_quota;
            $subscriptionLog->save();

        }

        foreach (token::all() as $token) {
            messages::factory()->create([
                'created_at' => now()->subDays(rand(0, 5)),
                'token_id' => $token->id,
                'company_id' =>  $company->id,
            ]);
        }

         User::factory(10)->create();



        $this->call(RolesAndPermissionsSeeder::class);

    }
}
