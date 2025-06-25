<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\CompanyResource;
use App\Filament\Resources\TenantResource\Widgets\CompaniesStatsWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanies extends ListRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    protected function getHeaderWidgets(): array
    {
        return [
            CompaniesStatsWidget::class,
        ];
    }
}
