<?php

namespace App\Filament\Companies\Resources\SubscriptionsResource\Pages;

use App\Filament\Companies\Resources\SubscriptionsResource;
use App\Filament\Companies\Resources\SubscriptionsResource\Widgets\SubscriptionsStats;
use App\Filament\Companies\Resources\SubscriptionsResource\Widgets\TokensTable;
use App\Models\CompanySubscriptionLog;
use Filament\Actions;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSubscriptions extends ViewRecord
{
    protected static string $resource = SubscriptionsResource::class;



    protected function getFooterWidgets(): array
    {
        return [
            TokensTable::make(['subscription_Id' => $this->record->id]),
        ];
    }

}
