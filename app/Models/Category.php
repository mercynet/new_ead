<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use App\Traits\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
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
    use HasFactory, HasLogs, SoftDeletes, Searchable;

    protected $fillable = ['category_id', 'name', 'slug'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function subproducts(): HasManyThrough
    {
        return $this->hasManyThrough(Product::class, CategoryProduct::class, 'category_id', 'id', 'category_id', 'category_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class)->with('categories');
    }

    public function scopeNoParent($query)
    {
        return $query->whereNull('category_id');
    }
}
