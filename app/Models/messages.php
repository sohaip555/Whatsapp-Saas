<?php

namespace App\Models;

use Database\Factories\MessagesFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    /** @use HasFactory<MessagesFactory> */
    use HasFactory;

    protected $guarded = [];


    public function tokens(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(tokens::class);
    }

    public function scopeMessages(Builder $query): Builder
    {
        return $query->whereHas('tokens.subscriptionLogs', function ($q) {
            $q->where('tenant_id', auth('tenant')->id());
        });
    }
}
