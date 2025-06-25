<?php

namespace App\Filament\Companies\Resources\TokensResource\Pages;

use App\Filament\Companies\Resources\TokensResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewToken extends ViewRecord
{
    protected static string $resource = TokensResource::class;



    protected function getFooterWidgets(): array
    {
        return [
            TokensResource\Widgets\MessagesTable::make(['tokenId' => $this->record->id]),
        ];
    }
}
