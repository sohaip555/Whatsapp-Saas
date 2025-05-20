<?php

namespace App\Filament\Tenants\Resources\TokensResource\Pages;

use App\Filament\Tenants\Resources\TokensResource;
use App\Models\tokens;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTokens extends CreateRecord
{
    protected static string $resource = TokensResource::class;


    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        dd($data);
        tokens::create();

        $token = $this->record;

        $subscription = $token->tenant_subscription_log;

        if ($subscription && $subscription->message_balance >= $token->message_quota) {
            $subscription->message_balance -= $token->message_quota;
            $subscription->save();
        }

    }
}
