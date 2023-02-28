<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 */
class OrderTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'status',
        'comment',
        'customer_notified',
        'seller_notified',
        'admin_notified',
    ];

    protected $casts = [
        'customer_notified' => 'boolean',
        'seller_notified' => 'boolean',
        'admin_notified' => 'boolean',
        'status' => OrderStatusEnum::class,
    ];


    public function statusDescription(): Attribute
    {
        return Attribute::make(
            get: fn() => OrderStatusEnum::getLabel($this->status)
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
