<?php

namespace App\Models\Users;

use App\Traits\HasLog;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static get()
 * @method static select(string[] $array)
 * @method static create(array $validated)
 * @method static find(int $id)
 * @property mixed $id
 */
class Group extends Model
{
    use HasFactory, SoftDeletes, HasLog, Price;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'discount', 'commission'];

    protected $casts = [
        'discount' => 'decimal:2',
        'commission' => 'decimal:2',
    ];

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
