<?php

namespace App\Models;

use App\Traits\HasLog;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Coupon extends Model
{
    use HasFactory, SoftDeletes, HasLog, Price;

    /**
     * @var string[]
     */
    protected $fillable = [
        'discount_type',
        'total',
        'count_utilization',
        'count_user',
        'name',
        'code',
        'active',
        'date_from',
        'date_to',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * @return HasMany
     */
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
