<?php

namespace App\Models\Users;

use App\Enums\Users\Gender;
use App\Models\Language;
use App\Models\Timezone;
use App\Traits\HasLog;
use App\Traits\Image;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 * @method static create(array $array)
 */
class UserInfo extends Model
{
    use HasFactory, HasLog, Image;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'document',
        'identity_registry',
        'avatar',
        'birth_date',
        'gender',
        'where_know_us',
        'source',
    ];

    protected $casts = [
        'gender' => Gender::class,
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
