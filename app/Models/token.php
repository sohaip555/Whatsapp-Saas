<?php

namespace App\Models;

use Database\Factories\tokenFactory;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class token extends Model
{
    /** @use HasFactory<tokenFactory> */
    use HasFactory;

    protected $guarded = [];

    public function tenantSubscriptionLog(): BelongsTo
    {
        return $this->belongsTo(CompanySubscriptionLog::class);
    }

    public function messages(): token|\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(messages::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }


//    protected static function booted(): void
//    {
//        static::creating(function ($token) {
//            $token->company_id = auth()->user()->company_id;
//        });
//
//
//        static::created(function ($token) {
////            dd($token);
//            $subscription = $token->tenantSubscriptionLog;
//
//            if ($subscription && $subscription->message_balance >= $token->message_quota) {
//                $subscription->message_balance -= $token->message_quota;
//                $subscription->save();
//            }
//        });
//
//
//        static::deleted(function ($token) {
////            dd($token);
//            $subscription = $token->tenantSubscriptionLog;
//
//                $subscription->message_balance += $token->message_quota;
//                $subscription->save();
//
//        });
//    }


    public static function getForm()
    {
        return [
            Select::make('tenant_subscription_log_id')
                ->label('Subscription Log')
                ->relationship('tenantSubscriptionLog', 'name',
                    modifyQueryUsing: fn (Builder $query) => $query
                        ->where('company_id', auth()->user()->company_id)
                        ->where('company_subscription_logs.message_balance','>' , 0)
                        ->orderBy('created_at', 'desc')
                ),

            TextInput::make('message_quota')
                ->dehydrated(true)
                ->rule(function (callable $get) {
                    $subscriptionId = $get('tenant_subscription_log_id');

                    $subscription = \App\Models\CompanySubscriptionLog::find($subscriptionId);

                    return function (string $attribute, $value, callable $fail) use ($subscription) {
                        if ($value > $subscription->message_balance) {
                            $fail("الرصيد المتاح هو {$subscription->message_balance} فقط.");
                        }
                    };
                }),

            Hidden::make('token')
                ->dehydrated(true)
                ->default(function (){
                    return Str::random(64);
                }),

        ];
    }

    public static function getMyTable()
    {
        return [
            TextColumn::make('tenantSubscriptionLog.name')
                ->label('name')
                ->searchable(),
            TextColumn::make('token')->searchable()
                ->formatStateUsing(function ($state) {
                    return Str::limit($state, 20);
                }),
            TextColumn::make('message_quota'),
            ToggleColumn::make('isActive')
                ->label('Active')
                ->default(function ($status) {
                    return $status ? 'Active' : 'Inactive';
                }),
            TextColumn::make('created_at')->dateTime(),
        ];
    }



}
