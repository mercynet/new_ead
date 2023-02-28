<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static insert(array $lines)
 */
class OrderPaymentMode extends Model
{
    use HasFactory, Searchable, Price;

    protected $fillable = ['order_id', 'payment_mode_id', 'price'];

    protected $searchableFields = ['*'];

    protected $table = 'order_payment_modes';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class);
    }
}
