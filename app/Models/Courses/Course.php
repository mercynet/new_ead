<?php

namespace App\Models\Courses;

use App\Enums\CourseLevel;
use App\Enums\Users\Role;
use App\Models\Language;
use App\Models\Scopes\Searchable;
use App\Models\Users\User;
use App\Traits\Boolean;
use App\Traits\HasLog;
use App\Traits\Image;
use App\Traits\Price;
use Database\Factories\CourseFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 *
 * @method static select(string[] $array)
 * @method static create(array $data)
 */
class Course extends Model
{
    use HasFactory, HasLog, SoftDeletes, Price, Image, Boolean, Searchable;

    /**
     * @var string[]
     */
    protected $fillable = [
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
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    /**
     * @var array|string[]
     */
    protected array $searchableFields = [
        'name',
        'slug',
        'summary',
        'description',
        'pre_requisites',
        'target',
    ];

    public static function newFactory(): Factory
    {
        return CourseFactory::new();
    }

    public function prices(): MorphMany
    {
        return $this->morphMany(Price::class, 'priceable');
    }

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
    public function items(): HasMany
    {
        return $this->hasMany(CourseItem::class);
    }

    /**
     * @return HasMany
     */
    public function course_modules(): HasMany
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
     * @return BelongsToMany
     */
    public function instructors(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(CourseUser::class)->where(fn($query) => $query->where(['type' => Role::instructor->name]));
    }

    /**
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(CourseUser::class)->where(fn($query) => $query->where(['type' => Role::student->name]));
    }

    /**
     * @return Attribute
     */
    public function level_description(): Attribute
    {
        return Attribute::get(CourseLevel::getLabel($this->level));
    }
}
