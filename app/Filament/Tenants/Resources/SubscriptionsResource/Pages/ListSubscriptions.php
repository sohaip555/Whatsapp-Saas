<?php

namespace App\Filament\Tenants\Resources\SubscriptionsResource\Pages;

use App\Filament\Tenants\Resources\SubscriptionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubscriptions extends ListRecords
{
    protected static string $resource = SubscriptionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
