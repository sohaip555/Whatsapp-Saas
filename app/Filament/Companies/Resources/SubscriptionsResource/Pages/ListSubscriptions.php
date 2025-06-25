<?php

namespace App\Filament\Companies\Resources\SubscriptionsResource\Pages;

use App\Filament\Companies\Resources\SubscriptionsResource;
use App\Filament\Companies\Resources\SubscriptionsResource\Widgets\SubscriptionsStats;
use App\Filament\Companies\Resources\SubscriptionsResource\Widgets\TokensTable;
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

    public function getHeaderWidgets(): array
    {
        return [
            SubscriptionsStats::class,
        ];
    }




    public function getTabs(): array
    {
        return CompanySubscriptionLog::getMyTable();
    }

}
