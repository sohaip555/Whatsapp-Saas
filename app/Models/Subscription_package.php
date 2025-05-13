<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription_package extends Model
{
    /** @use HasFactory<\Database\Factories\Subscription_packageFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'message_balance'];

    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'subscription_package_id');
    }

}
