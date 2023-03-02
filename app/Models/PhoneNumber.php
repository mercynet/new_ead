<?php

namespace App\Models;

use App\Enums\Users\PhoneNumberType;
use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class PhoneNumber extends Model
{
    use HasFactory, HasLog;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'country_code',
        'area_code',
        'phone_number',
        'type',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'type' => PhoneNumberType::class,
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
