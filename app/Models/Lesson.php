<?php

namespace App\Models;

use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @method static inRandomOrder()
 */
class Lesson extends Model
{
    use HasFactory, HasLog;

    protected $fillable = [
        'course_id',
        'course_module_id',
        'name',
        'slug',
        'summary',
        'description',
        'is_free',
        'is_commentable',
        'active',
        'order',
        'video_type',
        'video_path',
        'video_duration',
        'video_downloadable',
        'image_featured',
        'meta_description',
        'meta_keywords',
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'active' => 'boolean',
        'is_free' => 'boolean',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function course_module(): BelongsTo
    {
        return $this->belongsTo(CourseModule::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
