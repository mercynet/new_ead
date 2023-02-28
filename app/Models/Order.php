<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use App\Models\Scopes\Searchable;
use App\Traits\HasLogs;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static create(mixed $validated)
 * @method static select(string[] $array)
 * @property mixed $id
 */
class Order extends Model
{
    use HasFactory, HasLogs, Searchable, SoftDeletes, Price;

    protected $fillable = [
        'customer_id',
        'seller_id',
        'status_id',
        'application_id',
        'order_number',
        'total',
        'discount',
        'seller_commission',
        'admin_commission',
        'status',
        'observations',
        'paid_at',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'paid_at' => 'datetime',
        'status' => OrderStatusEnum::class,
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function myStatus(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function orderLines(): HasMany
    {
        return $this->hasMany(OrderLine::class);
    }

    public function orderTransactions(): HasMany
    {
        return $this->hasMany(OrderTransaction::class);
    }

    public function lastOrderTransaction(): HasMany
    {
        return $this->hasMany(OrderTransaction::class)->latest();
    }

    public function orderPaymentModes(): HasMany
    {
        return $this->hasMany(OrderPaymentMode::class, 'order_id', 'id');
    }

    public function statusDescription(): Attribute
    {
        return Attribute::make(
            get: fn() => OrderStatusEnum::getLabel($this->status)
        );
    }
}
