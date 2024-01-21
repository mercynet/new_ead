<?php

namespace App\Models\Users;

use App\Models\Country;
use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @method static find(mixed $id)
 * @method static where(array $array)
 */
class Address extends Model
{
    use HasFactory, softDeletes, HasLog;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'zip_code',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'state',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
