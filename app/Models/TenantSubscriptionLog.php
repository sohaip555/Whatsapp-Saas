<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantSubscriptionLog extends Model
{
    /** @use HasFactory<\Database\Factories\TenantSubscriptionLogFactory> */
    use HasFactory;


    protected $fillable = [
        'tenant_id',
        'subscription_package_id',
        'subscribed_at',
    ];


    public function tenant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function subscriptionPackage(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Subscription_package::class);
    }

    public function message_management()
    {
        return $this->hasMany(MessageManagement::class);
    }

}
