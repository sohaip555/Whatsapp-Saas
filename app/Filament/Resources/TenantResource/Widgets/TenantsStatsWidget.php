<?php

namespace App\Filament\Resources\TenantResource\Widgets;

use App\Filament\Resources\TenantResource;
use App\Models\Tenant;
use App\Models\TenantSubscriptionLog;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TenantsStatsWidget extends BaseWidget
{

//    protected string|int|array $columnSpan = '6/6';


    protected function getColumns(): int
    {
        return 2;
    }
    protected function getStats(): array
    {

        $TotalTenants = Stat::make('Total Tenants', Tenant::count())
            ->description('the total of tenants')
            ->icon('heroicon-o-building-office');



        $TotalSubscriptions = Stat::make('Total Subscriptions', TenantSubscriptionLog::count())
            ->description('the total of subscriptions')
            ->icon('heroicon-o-clipboard-document-check');

        return [
            $TotalTenants,
            $TotalSubscriptions,
        ];
    }
}
