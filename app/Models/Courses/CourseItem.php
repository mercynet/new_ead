<?php

namespace App\Models\Courses;

use App\Models\Scopes\Searchable;
use App\Traits\Boolean;
use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseItem extends Model
{
    use HasFactory, Boolean, Searchable, HasLog;

    protected $fillable = [
        'course_id',
        'name',
        'active',
    ];
    protected array $searchableFields = [
        'name',
    ];
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
