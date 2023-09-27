<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use App\Models\Users\User;
use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $array)
 */
class OrderTransaction extends Model
{
    use HasFactory, SoftDeletes, HasLog;

    protected $fillable = [
        'order_id',
        'user_id',
        'status',
        'comment',
        'user_notified',
        'admin_notified',
    ];

    protected $casts = [
        'user_notified' => 'boolean',
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
