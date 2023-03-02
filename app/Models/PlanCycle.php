<?php

namespace App\Models;

use App\Enums\Plans\CyclePeriod;
use App\Traits\HasLog;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class PlanCycle extends Model
{
    use HasFactory, HasLog, SoftDeletes, Price;

    /**
     * @var string[]
     */
    protected $fillable = [
        'plan_id',
        'period_access',
        'period_type',
        'is_recurring',
        'discount',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_recurring' => 'boolean',
        'period_type' => CyclePeriod::class,
    ];

    /**
     * @return BelongsTo
     */
    public function plans(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
