<?php

namespace App\Filament\Companies\Widgets;

use App\Models\messages;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class DashboardChart extends ChartWidget
{

    protected static ?int $sort = 2;

    protected  static ?string $heading = 'Send Messages';

    protected int | string | array $columnSpan = 'full';
    protected static ?string  $maxHeight = '300px';

    public ?string $filter = '6months';

    protected function getFilters(): ?array
    {
        return [
            'week' => 'last Week',
            'month' => 'last Month',
            '6months' => 'last 6 Month',

        ];
    }

    protected function getData(): array
    {
        match ($this->filter) {
            'week' => $data = Trend::model(messages::class)
                ->between(
                    start: now()->subWeek(),
                    end: now(),
                )
                ->perDay()
                ->count(),
            'month' => $data = Trend::model(messages::class)
                ->between(
                    start: now()->subMonth(),
                    end: now(),
                )
                ->perDay()
                ->count(),
            '6months' => $data = Trend::model(messages::class)
                ->between(
                    start: now()->subMonth(6),
                    end: now(),
                )
                ->perMonth()
                ->count(),

    };
        return [
            'datasets' => [
                [
                    'label' => 'Messages',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];

    }

    protected function getType(): string
    {
        return 'line';
    }
}
