<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class ModelHasQuiz extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'quiz_id',
        'model_type',
        'model_id',
    ];

    /**
     * @return BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
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
    public function lessons(): MorphToMany
    {
        return $this->morphedByMany(Lesson::class, 'model');
    }

    /**
     * @return MorphToMany
     */
    public function formations(): MorphToMany
    {
        return $this->morphedByMany(Formation::class, 'model');
    }
}
