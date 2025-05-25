<?php

namespace App\Filament\Tenants\Resources\TokensResource\Pages;

use App\Filament\Tenants\Resources\TokensResource;
use App\Models\token;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTokens extends CreateRecord
{
    protected static string $resource = TokensResource::class;


    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
//        dd($data);
        token::create();

        $token = $this->record;

        $subscription = $token->tenantSubscriptionLog;

        if ($subscription && $subscription->message_balance >= $token->message_quota) {
            $subscription->message_balance -= $token->message_quota;
            $subscription->save();
        }

    }
}
