<?php

namespace App\Filament\Tenants\Pages;

use App\Filament\Tenants\Widgets\DashboardChart;
use App\Filament\Tenants\Widgets\DashboardStats;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.tenants.pages.dashboard';


    public function getHeaderWidgets(): array
    {
        return [
            DashboardStats::class,
            DashboardChart::class,
        ];
    }

}
