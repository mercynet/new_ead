<?php

namespace App\Models;


use App\Traits\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static insert(array $lines)
 */
class OrderPaymentMode extends Model
{
    use HasFactory, Price;

    /**
     * @var string[]
     */
    protected $fillable = ['order_id', 'payment_mode_id', 'price'];

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function paymentMode(): BelongsTo
    {
        return $this->belongsTo(PaymentMode::class);
    }
}
