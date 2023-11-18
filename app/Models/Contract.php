<?php

namespace App\Models;

use App\Enums\ContractNotifyPeriod;
use App\Models\Courses\Course;
use App\Models\Courses\Formation;
use App\Models\Users\User;
use App\Traits\HasLog;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Contract extends Model
{
    use HasFactory, SoftDeletes, HasLog, Price;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'model_type',
        'model_id',
        'price',
        'renovation_tries',
        'notify_period',
        'notify_period_type',
        'is_recurring',
        'active',
        'limit_date',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_recurring' => 'boolean',
        'active' => 'boolean',
        'limit_date' => 'datetime',
        'notify_period_type' => ContractNotifyPeriod::class,
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return MorphToMany
     */
    public function course(): MorphToMany
    {
        return $this->morphedByMany(Course::class, 'model');
    }

    /**
     * @return MorphToMany
     */
    public function formation(): MorphToMany
    {
        return $this->morphedByMany(Formation::class, 'model');
    }

    /**
     * @return MorphToMany
     */
    public function plan(): MorphToMany
    {
        return $this->morphedByMany(Plan::class, 'model');
    }
}
