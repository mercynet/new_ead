<?php

namespace App\Models\Users;

use App\Enums\Users\Gender;
use App\Models\Language;
use App\Models\Timezone;
use App\Traits\HasLog;
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
    use HasFactory, HasLog;

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

    /**
     * @return Attribute
     */
    public function image(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->avatar && !str_contains($this->avatar, 'storage/blank.png')) {
                    return asset("storage/" . str_replace(config('app.url') . "/storage/", '', $this->avatar));
                }
                return asset('storage/blank.png');
            },
        );
    }
}
