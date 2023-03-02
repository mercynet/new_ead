<?php

namespace App\Models;

use App\Traits\HasLog;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static create()
 * @method static insert(array $lines)
 */
class OrderLine extends Model
{
    use HasFactory, SoftDeletes, HasLog, Price;

    /**
     * @var string[]
     */
    protected $fillable = [
        'order_id',
        'model_type',
        'model_id',
        'model_name',
        'model_price',
        'model_discount',
        'model_quantity',
        'model_details',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'model_details' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
