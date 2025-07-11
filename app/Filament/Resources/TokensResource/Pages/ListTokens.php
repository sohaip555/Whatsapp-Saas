<?php

namespace App\Filament\Resources\TokensResource\Pages;

use App\Filament\Resources\TokensResource;
use App\Filament\Resources\TokensResource\Widgets\TokenStats;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListTokens extends ListRecords
{
    use ExposesTableToWidgets;


    protected static string $resource = TokensResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    public function getHeaderWidgets(): array
    {
        return [
            TokenStats::class,
        ];
    }


    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'Active' => Tab::make('Active')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('isActive', true);
                }),
            "Inactive" => Tab::make('Inactive')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('isActive', false);
                })

        ];
    }
}
