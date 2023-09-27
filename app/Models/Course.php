<?php

namespace App\Models;

use App\Enums\CourseLevel;
use App\Traits\HasLog;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Course extends Model
{
    use HasFactory, HasLog, SoftDeletes, Price;

    /**
     * @var string[]
     */
    protected $fillable = [
        'language_id',
        'order',
        'name',
        'slug',
        'level',
        'summary',
        'description',
        'pre_requisites',
        'target',
        'image_featured',
        'image_cover',
        'is_fifo',
        'active',
        'meta_description',
        'meta_keywords',
        'price',
        'access_months',
        'started_at',
        'ended_at',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_fifo' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * @return BelongsToMany
     */
    public function formations(): BelongsToMany
    {
        return $this->belongsToMany(Formation::class);
    }

    /**
     * @return HasMany
     */
    public function modules(): HasMany
    {
        return $this->hasMany(CourseModule::class);
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * @return HasMany
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * @return Attribute
     */
    public function level_description(): Attribute
    {
        return Attribute::get(CourseLevel::getLabel($this->level));
    }
}
