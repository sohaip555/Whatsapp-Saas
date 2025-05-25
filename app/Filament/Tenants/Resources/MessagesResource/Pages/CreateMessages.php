<?php

namespace App\Filament\Tenants\Resources\MessagesResource\Pages;

use App\Filament\Tenants\Resources\MessagesResource;
use App\Models\token;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMessages extends CreateRecord
{
    protected static string $resource = MessagesResource::class;

}
