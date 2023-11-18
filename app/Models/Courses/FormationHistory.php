<?php

namespace App\Models\Courses;

use App\Traits\HasLog;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormationHistory extends Model
{
    use HasFactory, HasLog, SoftDeletes, Price;

    /**
     * @var string[]
     */
    protected $fillable = [
        'formation_id',
        'formation_name',
        'formation_price',
    ];

    /**
     * @return BelongsTo
     */
    public function formations(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }
}
