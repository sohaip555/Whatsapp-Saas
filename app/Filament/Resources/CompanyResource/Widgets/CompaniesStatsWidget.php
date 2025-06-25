<?php

namespace App\Filament\Resources\TenantResource\Widgets;

use App\Filament\Resources\CompanyResource;
use App\Models\Company;
use App\Models\CompanySubscriptionLog;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CompaniesStatsWidget extends BaseWidget
{

//    protected string|int|array $columnSpan = '6/6';


    protected function getColumns(): int
    {
        return 2;
    }
    protected function getStats(): array
    {

        $TotalTenants = Stat::make('Total Company', Company::count())
            ->description('the total of companies')
            ->icon('heroicon-o-building-office');



        $TotalSubscriptions = Stat::make('Total Subscriptions', CompanySubscriptionLog::count())
            ->description('the total of subscriptions')
            ->icon('heroicon-o-clipboard-document-check');

        return [
            $TotalTenants,
            $TotalSubscriptions,
        ];
    }
}
