<?php

namespace App\Filament\Tenants\Resources\MessagesResource\Pages;

use App\Filament\Tenants\Resources\MessagesResource;
use App\Filament\Tenants\Widgets\DashboardStats;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMessages extends ListRecords
{
    protected static string $resource = MessagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }


    protected function getHeaderWidgets(): array
    {
        return [
            DashboardStats::class,
        ];
    }
}
