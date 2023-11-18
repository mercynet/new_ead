<?php

namespace App\Models;

use App\Models\Courses\Course;
use App\Models\Courses\Formation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class ModelHasDiscountRule extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'discount_rule_id',
        'model_type',
        'model_id',
    ];

    /**
     * @return BelongsTo
     */
    public function discount_rule(): BelongsTo
    {
        return $this->belongsTo(DiscountRule::class);
    }

    /**
     * @return MorphToMany
     */
    public function courses(): MorphToMany
    {
        return $this->morphedByMany(Course::class, 'model');
    }

    /**
     * @return MorphToMany
     */
    public function formations(): MorphToMany
    {
        return $this->morphedByMany(Formation::class, 'model');
    }

    /**
     * @return MorphToMany
     */
    public function plans(): MorphToMany
    {
        return $this->morphedByMany(Plan::class, 'model');
    }
}
