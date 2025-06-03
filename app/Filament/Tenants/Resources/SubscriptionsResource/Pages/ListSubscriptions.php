<?php

namespace App\Filament\Tenants\Resources\SubscriptionsResource\Pages;

use App\Filament\Tenants\Resources\SubscriptionsResource;
use App\Filament\Tenants\Resources\SubscriptionsResource\Widgets\SubscriptionsStats;
use App\Filament\Tenants\Resources\SubscriptionsResource\Widgets\TokensTable;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListSubscriptions extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = SubscriptionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeaderWidgets(): array
    {
        return [
            SubscriptionsStats::class,
        ];
    }




    public function getTabs(): array
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

}
