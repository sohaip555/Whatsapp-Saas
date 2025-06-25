<?php

namespace App\Filament\Resources\SubscriptionsResource\Pages;

use App\Filament\Resources\SubscriptionsResource;
use App\Filament\Resources\SubscriptionsResource\Widgets\SubscriptionsStats;
use App\Models\CompanySubscriptionLog;
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


    protected function getHeaderWidgets(): array
    {
        return [SubscriptionsStats::class];
    }

    public function getTabs(): array
    {
        return CompanySubscriptionLog::getMyTable();
    }
}
