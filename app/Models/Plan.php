<?php

namespace App\Models;

use App\Traits\HasLog;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Plan extends Model
{
    use HasFactory, HasLog, Price, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'order',
        'name',
        'slug',
        'color',
        'description',
        'price',
        'active',
        'is_test',
        'is_commissioned',
        'is_promotional',
        'is_showcase',
        'is_featured',
        'countdown_limit',
        'published_at',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'active' => 'boolean',
        'is_test' => 'boolean',
        'is_commissioned' => 'boolean',
        'is_promotional' => 'boolean',
        'is_showcase' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * @return BelongsToMany
     */
    public function items(): BelongsToMany
    {
        return $this->belongsToMany(PlanItemPlan::class);
    }

    /**
     * @return BelongsTo
     */
    public function cycles(): BelongsTo
    {
        return $this->belongsTo(PlanCycle::class);
    }
}
