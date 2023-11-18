<?php

namespace App\Models;

use App\Models\Courses\Course;
use App\Models\Courses\Formation;
use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class ModelHasBanner extends Model
{
    use HasLog;

    protected $fillable = [
        'banner_id',
        'model_type',
        'model_id',
    ];


    /**
     * @return BelongsTo
     */
    public function banner(): BelongsTo
    {
        return $this->belongsTo(Banner::class);
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
}
