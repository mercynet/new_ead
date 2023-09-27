<?php

namespace App\Models\Users;

use App\Enums\Users\Gender;
use App\Models\Language;
use App\Models\Timezone;
use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 * @method static create(array $array)
 */
class UserInfo extends Model
{
    use HasFactory, HasLog;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'address_id',
        'language_id',
        'timezone_id',
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

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * @return BelongsTo
     */
    public function timezone(): BelongsTo
    {
        return $this->belongsTo(Timezone::class);
    }
}
