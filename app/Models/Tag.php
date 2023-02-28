<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use App\Traits\HasLogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @method static select(string[] $array)
 * @method static firstOrCreate(array $array)
 * @method static search(mixed $search)
 */
class Tag extends Model
{
    use HasFactory, HasLogs, Searchable;
    protected $fillable = ['name', 'slug'];

    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }
}
