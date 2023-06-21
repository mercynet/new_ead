<?php

namespace App\Models;

use App\Traits\HasLog;
use App\Traits\HasRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Instructor extends Model
{
    use HasFactory, SoftDeletes, HasLog, HasRole;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'commission',
        'bank_iban',
        'bank_name',
        'identify_image',
        'financial_approved',
        'available_meetings',
        'sex_meetings',
        'meeting_type',
    ];

    protected $casts = [
        'financial_approved' => 'boolean',
        'available_meetings' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
