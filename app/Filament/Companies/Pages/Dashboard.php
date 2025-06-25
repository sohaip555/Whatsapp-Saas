<?php

namespace App\Filament\Companies\Pages;

use App\Filament\Companies\Widgets\DashboardChart;
use App\Filament\Companies\Widgets\DashboardStats;
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
