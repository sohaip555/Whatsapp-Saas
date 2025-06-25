<?php


use App\Filament\Resources\SubscriptionsResource\Pages\CreateSubscriptions;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    actAsAdmin();

    Company::factory()->create([
        'name' => 'Test',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
    ]);

});


it('has form to create new SubscriptionLog', function () {

    Livewire::test(CreateSubscriptions::class)
        ->assertFormExists();

});

it('can render the correct fields', function () {

    Livewire::test(CreateSubscriptions::class)
        ->assertFormFieldExists('name')
        ->assertFormFieldExists('subscription_package_id')
        ->assertFormFieldExists('company_id')
        ->assertFormFieldExists('message_balance')
        ->assertSee('price_display');

});

describe('validation rule is working', function () {

    it('', function () {
        Livewire::test(CreateSubscriptions::class)
            ->fillForm(['name' => null])
            ->call('create')
            ->assertHasFormErrors(['name' => 'required'])
            ->fillForm(['name' => str_repeat('a', 51)])
            ->call('create')
            ->assertHasFormErrors(['name' => 'max'])
            ->fillForm(['subscription_package_id' => null])
            ->call('create')
            ->assertHasFormErrors(['subscription_package_id' => 'required']);

    });
});


it('creates a subscription log if the validation passes', function () {

    $package =\App\Models\SubscriptionPackage::factory()->create();

    Livewire::test(CreateSubscriptions::class)
        ->fillForm([
            'name' => 'dskchskldc',
            'subscription_package_id' => $package->id,
            'message_balance' => $package->message_balance,
        ])
        ->call('create');

    $this->assertDatabaseHas('company_subscription_logs', [
        'name' => 'dskchskldc',
        'subscription_package_id' => $package->id,
        'message_balance' => $package->message_balance,
        'company_id' => auth()->user()->company_id ?? Company::where(['email' => 'admin@example.com'])->first()->id,
    ]);



});
