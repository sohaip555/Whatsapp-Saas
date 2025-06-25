<?php

namespace App\Filament\Resources\TokensResource\Pages;

use App\Filament\Resources\TokensResource;
use App\Filament\Companies\Resources\TokensResource\Widgets\MessagesTable;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTokens extends ViewRecord
{
    protected static string $resource = TokensResource::class;


    protected function getFooterWidgets(): array
    {
        return [
            MessagesTable::make(['tokenId' => $this->record->id]),
        ];
    }
}
