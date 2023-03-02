<?php

namespace App\Models;

use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static inRandomOrder()
 */
class Lesson extends Model
{
    use HasFactory, HasLog, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'course_id',
        'course_module_id',
        'language_id',
        'order',
        'name',
        'slug',
        'video_type',
        'video_path',
        'video_duration',
        'video_downloadable',
        'summary',
        'description',
        'image_featured',
        'meta_description',
        'meta_keywords',
        'is_free',
        'is_commentable',
        'active',
        'started_at',
        'ended_at',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'active' => 'boolean',
        'is_free' => 'boolean',
        'is_commentable' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return BelongsTo
     */
    public function course_module(): BelongsTo
    {
        return $this->belongsTo(CourseModule::class);
    }

    /**
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
