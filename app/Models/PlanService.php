<?php

namespace App\Models;

use App\Enums\Plans\ServiceType;
use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class PlanService extends Model
{
    use HasFactory, SoftDeletes, HasLog;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'model_type',
        'description',
        'type',
        'show_description',
        'show_count_left',
        'active',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'active' => 'boolean',
        'show_description' => 'boolean',
        'show_count_left' => 'boolean',
        'type' => ServiceType::class
    ];

    /**
     * @return BelongsToMany
     */
    public function plan(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class);
    }
}
