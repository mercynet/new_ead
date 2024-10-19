<?php

namespace App\Models\Courses;

use App\Models\Language;
use App\Traits\HasLog;
use Database\Factories\CourseModuleFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class CourseModule extends Model
{
    use HasFactory, HasLog, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'course_id',
        'language_id',
        'name',
        'slug',
    ];

    public static function newFactory(): Factory
    {
        return CourseModuleFactory::new();
    }

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
    public function lessons(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
