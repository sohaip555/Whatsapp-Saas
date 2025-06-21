<?php

namespace App\Filament\Resources\SubscriptionsResource\Widgets;

use App\Filament\Resources\SubscriptionsResource\Pages\ListSubscriptions;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SubscriptionsStats extends BaseWidget
{

    use InteractsWithPageTable;

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getTablePage(): string
    {
        return ListSubscriptions::class;
    }

    protected function getStats(): array
    {
        $subscriptions = $this->getPageTableQuery();

        $count = $subscriptions->count();


        $activeSubscriptionsWithMessages = $subscriptions
            ->where('message_balance', '>', 0)
            ->count();
//        dd($count, $activeSubscriptionsWithMessages);

        return [
            Stat::make('Total Subscriptions', $count)
                ->description('All time total')
                ->color('primary'),


            Stat::make('Subscriptions With Messages', $activeSubscriptionsWithMessages)
                ->description('Subscriptions that has messages')
                ->color('silver')
                ->icon('heroicon-o-chat-bubble-bottom-center-text'),
        ];
    }
}
