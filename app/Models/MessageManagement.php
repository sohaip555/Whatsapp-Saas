<?php

namespace App\Models;

use Database\Factories\MessageManagementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageManagement extends Model
{
    /** @use HasFactory<MessageManagementFactory> */
    use HasFactory;

    public function tenant_subscription_log(): BelongsTo
    {
        return $this->belongsTo(TenantSubscriptionLog::class);
    }
}
