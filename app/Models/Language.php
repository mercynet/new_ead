<?php

namespace App\Models;

use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Language extends Model
{
    use HasFactory, HasLog, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'active',
        'locale',
        'name',
        'code',
        'icon',
    ];

    /**
     * @return HasManyThrough
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, UserInfo::class);
    }
}
