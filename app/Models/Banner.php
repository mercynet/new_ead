<?php

namespace App\Models;

use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 *
 */
class Banner extends Model
{
    use HasFactory, HasLog;

    /**
     * @var string[]
     */
    protected $fillable = [
        'order',
        'time_to_view',
        'name',
        'description',
        'url',
        'video',
        'banner',
        'banner_mobile',
        'local',
        'active',
        'date_from',
        'date_to',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
