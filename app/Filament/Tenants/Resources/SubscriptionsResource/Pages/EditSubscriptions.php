<?php

namespace App\Filament\Tenants\Resources\SubscriptionsResource\Pages;

use App\Filament\Tenants\Resources\SubscriptionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubscriptions extends EditRecord
{
    protected static string $resource = SubscriptionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
