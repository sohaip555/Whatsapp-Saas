<?php

namespace App\Models;

use App\Enums\SubscriptionColor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscriptionPackage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
//            'name' => SubscriptionColor::class,
        ];
    }

    public function tenantSubscriptionLogs(): HasMany
    {
        return $this->hasMany(CompanySubscriptionLog::class);
    }
}
