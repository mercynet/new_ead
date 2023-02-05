<?php

namespace App\Models;

use App\Enums\CourseLevel;
use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 */
class Course extends Model
{
    use HasFactory, HasLog;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'summary',
        'description',
        'pre_requisites',
        'target',
        'thumbnail',
        'image_cover',
        'is_fifo',
        'active',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'fifo' => 'boolean',
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

    public function levelDescription(): Attribute
    {
        return Attribute::get(CourseLevel::getLabel($this->level));
    }
}
