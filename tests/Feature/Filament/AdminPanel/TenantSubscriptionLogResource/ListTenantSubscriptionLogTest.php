<?php

use App\Filament\Resources\SubscriptionsResource\Pages\CreateSubscriptions;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    actAsAdmin();

    Tenant::factory()->create([
        'name' => 'Test',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
    ]);

});



it('', function () {
});
