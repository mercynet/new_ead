<?php

namespace App\Models;

use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class PlanItem extends Model
{
    use HasFactory, HasLog, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'is_featured',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_featured' => 'boolean',
    ];

    /**
     * @return BelongsToMany
     */
    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class);
    }
}
