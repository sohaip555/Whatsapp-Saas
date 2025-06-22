<?php

namespace App\Models;

use Filament\Facades\Filament;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantSubscriptionLog extends Model
{
    /** @use HasFactory<\Database\Factories\TenantSubscriptionLogFactory> */
    use HasFactory;


    protected $guarded = [];

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
        return $this->hasMany(token::class);
    }

    public static function getForm()
    {

        return [
            TextInput::make('name')
                ->required()
                ->maxLength(50),



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

                    return auth()->user()->tenant_id;
                }),

            Hidden::make('message_balance')
                ->dehydrated(true)
                ->default(function (){
                    return 0;
                }),


        ];
    }


    public static function getMyTable()
    {
        return [
                'all' => Tab::make('All'),
                'platinum' => Tab::make('platinum')
                    ->modifyQueryUsing(function ($query) {
                        return $query->whereHas('subscriptionPackage',  function ($query) {
                            return $query->where('subscription_packages.name', 'platinum');
                        });
                    }),
                'gold' => Tab::make('Gold')
                    ->modifyQueryUsing(function ($query) {
                        return $query->whereHas('subscriptionPackage',  function ($query) {
                            return $query->where('subscription_packages.name', 'gold');
                        });
                    }),
                'silver' => Tab::make('silver')
                    ->modifyQueryUsing(function ($query) {
                        return $query->whereHas('subscriptionPackage',  function ($query) {
                            return $query->where('subscription_packages.name', 'silver');
                        });
                    }),
                'bronze' => Tab::make('bronze')
                    ->modifyQueryUsing(function ($query) {
                        return $query->whereHas('subscriptionPackage',  function ($query) {
                            return $query->where('subscription_packages.name', 'bronze');
                        });
                    }),
            ];
    }


    public static function getMyInfolist()
    {
        return [
                \Filament\Infolists\Components\Section::make('Subscription Details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Name'),

                        TextEntry::make('subscriptionPackage.name')
                            ->label('Package Name')
                            ->badge()
                            ->color(function ($state) {
                                return $state;
                            }),

                        TextEntry::make('message_balance')
                            ->label('Message Balance'),
                    ]),

//                Section::make('Metadata')
//                    ->columns(2)
//                    ->schema([
//                        TextEntry::make('created_at')
//                            ->label('Created At')
//                            ->dateTime(),
//
//                        TextEntry::make('updated_at')
//                            ->label('Updated At')
//                            ->dateTime(),
//                    ]),
            ];
    }




}
