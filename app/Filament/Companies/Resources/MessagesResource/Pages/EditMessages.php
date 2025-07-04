<?php

namespace App\Filament\Companies\Resources\MessagesResource\Pages;

use App\Filament\Companies\Resources\MessagesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMessages extends EditRecord
{
    protected static string $resource = MessagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
