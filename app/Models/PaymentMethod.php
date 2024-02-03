<?php

namespace App\Models;

use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

/**
 * @method static hasCountry()
 */
class PaymentMethod extends Model
{
    use HasFactory, HasLog;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'alias',
        'image',
        'active',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'pivot'
    ];

    /**
     * @return BelongsTo
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(PaymentMode::class);
    }

    /**
     * @return string
     */
    public function getImageAttribute(): string
    {
        if ($this->image_path && !Str::contains($this->image_path, 'storage/blank.png')) {
            return asset("storage/payments/methods/{$this->image_path}");
        }
        return asset('storage/blank.png');
    }
}
