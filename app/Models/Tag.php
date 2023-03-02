<?php

namespace App\Models;


use App\Traits\HasLog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @method static select(string[] $array)
 * @method static firstOrCreate(array $array)
 * @method static search(mixed $search)
 */
class Tag extends Model
{
    use HasFactory, HasLog;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'slug', 'language_id'];

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
