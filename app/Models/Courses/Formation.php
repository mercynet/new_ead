<?php

namespace App\Models\Courses;

use App\Models\Language;
use App\Traits\HasLog;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Formation extends Model
{
    use HasFactory, SoftDeletes, HasLog, Price;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'language_id',
        'name',
        'slug',
        'description',
        'price',
        'points',
        'access_months',
        'is_fifo',
        'active',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_fifo' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * @return BelongsToMany
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
