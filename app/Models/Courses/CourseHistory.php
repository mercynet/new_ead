<?php

namespace App\Models\Courses;

use App\Traits\HasLog;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class CourseHistory extends Model
{
    use HasFactory, HasLog, SoftDeletes, Price;

    /**
     * @var string[]
     */
    protected $fillable = [
        'course_id',
        'course_name',
        'course_price',
    ];

    /**
     * @return BelongsTo
     */
    public function courses(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
