<?php

namespace App\Models;

use App\Traits\HasLog;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @method static where(array $array)
 * @method static create(array $array)
 * @property float|mixed $amount
 * @property int|mixed $active
 */
class DiscountRule extends Model
{
    use HasFactory, HasLog, SoftDeletes, Price;

    /**
     * @var string[]
     */
    protected $fillable = [
        'amount',
        'name',
        'active',
        'discount_type',
        'date_from',
        'date_to',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'active' => 'boolean',
        'date_from' => 'date:d/m/Y',
        'date_to' => 'date:d/m/Y',
    ];
}
