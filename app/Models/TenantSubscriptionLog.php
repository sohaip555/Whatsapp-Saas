<?php

namespace App\Models;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantSubscriptionLog extends Model
{
    /** @use HasFactory<\Database\Factories\TenantSubscriptionLogFactory> */
    use HasFactory;


    protected $guarded = [];

    public static function getForm(Form $form)
    {

        return [
            TextInput::make('name'),


            Section::make([
                Select::make('subscription_package_id')
                    ->relationship('subscriptionPackage', 'name')
                    ->required()
                    ->preload()
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set) {
                        $package = SubscriptionPackage::find($state);
                        $set('price_display', $package ? '$' . number_format($package->price, 2) : '$0.00');
                        $set('message_balance', $package ? $package->message_balance : '0');
                    })->columnSpan(2),

                Placeholder::make('price_display')
                    ->label('Price')
                    ->content(function (Get $get) {
                        $packageId = $get('subscription_package_id');
                        if (!$packageId) return '$0.00';

                        $package = SubscriptionPackage::find($packageId);
                        return $package ? '$' . number_format($package->price, 2) : '$0.00';
                    })
            ])->columns(3),


            Hidden::make('tenant_id')
                ->dehydrated(true)
                ->default(function (){
                    return auth('tenant')->id();
                }),

            Hidden::make('message_balance')
                ->dehydrated(true)
                ->default(function (){
                    return 0;
                }),


        ];
    }


    public function tenant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function subscriptionPackage(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SubscriptionPackage::class);
    }

    public function tokens()
    {
        return $this->hasMany(tokens::class);
    }

}
