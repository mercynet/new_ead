<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use App\Traits\HasLogs;
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
    use HasFactory, HasLogs, Searchable, SoftDeletes, Price;

    /**
     * @var string[]
     */
    protected $fillable = [
        'application_id',
        'product_id',
        'name',
        'type',
        'amount',
        'active',
        'date_from',
        'date_to',
    ];

    /**
     * @var string[]
     */
    protected $searchableFields = ['*'];

    /**
     * @var string[]
     */
    protected $casts = [
        'active' => 'boolean',
        'date_from' => 'date:d/m/Y',
        'date_to' => 'date:d/m/Y',
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}
