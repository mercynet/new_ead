<?php

namespace App\Models;

use App\Models\Courses\Course;
use App\Models\Scopes\Searchable;
use App\Traits\Boolean;
use App\Traits\HasLog;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static select(string[] $array)
 * @method static firstOrCreate(array $array)
 * @method static search(mixed $search)
 * @method static create(mixed $validated)
 * @method static whereNull(string $string)
 * @method static noParent()
 */
class Category extends Model
{
    use HasFactory, HasLog, SoftDeletes, Image, Boolean, Searchable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'order',
        'is_showcase',
        'active',
        'name',
        'slug',
        'description',
        'image',
    ];

    /**
     * @var array|string[]
     */
    protected array $searchableFields = [
        'name',
        'slug',
        'description',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_showcase' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(self::class)->orderBy('order')->orderBy('id');
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class)->orderBy('order')->orderBy('id')->with('children');
    }

    /**
     * @return BelongsToMany
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)->using(CategoryCourse::class);
    }

    /*
     * Scopes
     */

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNoParent($query): Builder
    {
        return $query->whereNull('category_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query): Builder
    {
        return $query->where(['active' => true]);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeShowcase($query): Builder
    {
        return $query->where(['is_showcase' => true]);
    }
}
