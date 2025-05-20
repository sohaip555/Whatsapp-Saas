<?php

namespace App\Filament\Tenants\Resources\TokensResource\Pages;

use App\Filament\Tenants\Resources\TokensResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTokens extends ListRecords
{
    protected static string $resource = TokensResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
