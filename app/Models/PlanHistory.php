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
class PlanHistory extends Model
{
    use HasFactory, HasLog, SoftDeletes, Price;

    /**
     * @var string[]
     */
    protected $fillable = [
        'plan_id',
        'plan_name',
        'plan_price',
    ];

    /**
     * @return HasMany
     */
    public function plan(): HasMany
    {
        return $this->hasMany(Plan::class);
    }
}
