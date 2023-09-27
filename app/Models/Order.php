<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use App\Models\Users\User;
use App\Traits\HasLog;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(mixed $validated)
 * @method static select(string[] $array)
 * @property mixed $id
 */
class Order extends Model
{
    use HasFactory, HasLog, SoftDeletes, Price;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'coupon_id',
        'reference',
        'total',
        'discount',
        'paid',
        'commission',
        'status',
        'observations',
        'paid_at',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'paid_at' => 'datetime',
        'status' => OrderStatusEnum::class,
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
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * @return BelongsTo
     */
    public function paymentMode(): BelongsTo
    {
        return $this->belongsTo(PaymentMode::class);
    }

    /**
     * @return HasMany
     */
    public function orderLines(): HasMany
    {
        return $this->hasMany(OrderLine::class);
    }

    /**
     * @return HasMany
     */
    public function orderTransactions(): HasMany
    {
        return $this->hasMany(OrderTransaction::class);
    }

    /**
     * @return HasMany
     */
    public function lastOrderTransaction(): HasMany
    {
        return $this->hasMany(OrderTransaction::class)->latest();
    }

    /**
     * @return Attribute
     */
    public function statusDescription(): Attribute
    {
        return Attribute::make(
            get: fn() => OrderStatusEnum::getLabel($this->status)
        );
    }
}
