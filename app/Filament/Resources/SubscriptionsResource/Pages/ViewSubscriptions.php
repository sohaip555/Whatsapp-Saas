<?php

namespace App\Filament\Resources\SubscriptionsResource\Pages;

use App\Filament\Resources\SubscriptionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSubscriptions extends ViewRecord
{
    protected static string $resource = SubscriptionsResource::class;


    public  function getFooterWidgets(): array
    {
        return [
            SubscriptionsResource\Widgets\TokensTable::class,
        ];
    }
}
