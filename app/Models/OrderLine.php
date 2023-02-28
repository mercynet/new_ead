<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
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
    use HasFactory, Searchable, SoftDeletes, Price;

    /**
     * @var string[]
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'product_sku',
        'product_price',
        'product_discount',
        'product_quantity',
        'product_details',
    ];

    /**
     * @var string[]
     */
    protected $searchableFields = ['*'];

    /**
     * @var string[]
     */
    protected $casts = [
        'product_details' => 'array',
    ];

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
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
