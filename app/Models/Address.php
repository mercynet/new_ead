<?php

namespace App\Models;

use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
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
        'country',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
