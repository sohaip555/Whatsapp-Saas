<?php

namespace App\Filament\Tenants\Resources\TokensResource\Widgets;

use App\Models\messages;
use App\Models\Tenant;
use App\Models\token;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TokenStats extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return \App\Filament\Tenants\Resources\TokensResource\Pages\ListTokens::class;
    }

    protected static ?int $sort = 2;

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        $Tokens = $this->getPageTableQuery();

        // Messages
        $NumberOfTokens = $Tokens->count();

        $SumOfMessageQuota = $Tokens->sum('message_quota');
//        dd($SumOfMessageQuota);

        return [
            Stat::make('TokensTable', $NumberOfTokens)
                ->description('The number of tokens that have been created')
                ->icon('heroicon-o-key'),
            Stat::make('Message Quota', $SumOfMessageQuota)
                ->description('Total remaining message quotas')
            ->icon('heroicon-o-envelope'),


        ];
    }


}
