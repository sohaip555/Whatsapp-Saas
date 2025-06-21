<?php

namespace App\Filament\Tenants\Widgets;

use App\Models\messages;
use App\Models\Tenant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class DashboardStats extends BaseWidget
{

    protected static ?int $sort = 2;

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        $tenantId = auth()->user()->tenant_id;
        $tenant = Tenant::findOrFail($tenantId);

        // Messages
        $messages = messages::whereIn('token_id', $tenant->tokens->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->get();

        $firstMessageDate = $messages->last()?->created_at;
        $startDate = $firstMessageDate ? Carbon::parse($firstMessageDate)->startOfDay() : null;
        $endDate = now()->endOfDay();
        $daysDiff = $startDate ? $startDate->diffInDays($endDate) : 0;

        $dailyCounts = $startDate ? collect(range(0, $daysDiff))->map(function ($day) use ($startDate, $messages) {
            $date = $startDate->copy()->addDays($day);
            return $messages->filter(fn ($message) => Carbon::parse($message->created_at)->isSameDay($date))->count();
        })->toArray() : [];

        $sentMessagesStat = Stat::make('Sent Messages', $startDate ? array_sum($dailyCounts) : 0)
            ->description($startDate ? 'From first sent message ' . $startDate->format('M jS') . ' to ' . $endDate->format('M jS') : 'No messages sent yet')
            ->descriptionIcon('heroicon-o-paper-airplane')
            ->icon('heroicon-o-paper-airplane')
            ->color('success')
            ->chart($dailyCounts);


        $totalPaid = $tenant->subscriptionLogs()
            ->with('subscriptionPackage')
            ->get()
            ->sum(fn ($log) => $log->subscriptionPackage->price ?? 0);


        $totalPaidStat = Stat::make('Total Paid', number_format($totalPaid, 2) . ' LYD')
            ->description('Total spent on subscriptions')
            ->color('success')
            ->icon('heroicon-o-currency-dollar');

        return [
            $sentMessagesStat,
            $totalPaidStat,
        ];
    }
}

