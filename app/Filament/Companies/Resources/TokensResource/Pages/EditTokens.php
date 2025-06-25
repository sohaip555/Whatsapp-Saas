<?php

namespace App\Filament\Companies\Resources\TokensResource\Pages;

use App\Filament\Companies\Resources\TokensResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTokens extends EditRecord
{
    protected static string $resource = TokensResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
