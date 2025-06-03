<?php

namespace App\Filament\Tenants\Resources\SubscriptionsResource\Pages;

use App\Filament\Tenants\Resources\SubscriptionsResource;
use App\Filament\Tenants\Resources\SubscriptionsResource\Widgets\SubscriptionsStats;
use App\Filament\Tenants\Resources\SubscriptionsResource\Widgets\TokensTable;
use App\Models\TenantSubscriptionLog;
use Filament\Actions;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTokens extends ViewRecord
{
    protected static string $resource = SubscriptionsResource::class;



    protected function getFooterWidgets(): array
    {
        return [
            TokensTable::make(['subscription_Id' => $this->record->id]),
        ];
    }

}
