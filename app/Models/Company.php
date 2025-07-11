<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $guarded = [];

    public function subscriptionLogs()
    {
        return $this->hasMany(CompanySubscriptionLog::class);
    }

    public function tokens()
    {
        return $this->hasManyThrough(token::class, CompanySubscriptionLog::class);
    }

    //
    //

}
