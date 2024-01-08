<?php

namespace App\Models;

use App\Enums\Quizzes\ExibitionType;
use App\Enums\Quizzes\FormatType;
use App\Enums\Quizzes\QuestionType;
use App\Models\Users\Group;
use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Quiz extends Model
{
    use HasFactory, SoftDeletes, HasLog;

    /**
     * @var string[]
     */
    protected $fillable = [
        'group_id',
        'order',
        'question',
        'video',
        'exhibition_type',
        'format_type',
        'question_type',
        'level',
        'is_random',
        'is_free',
        'allow_remake',
        'active',
        'published_at',
        'date_from',
        'date_to',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'exhibition_type' => ExibitionType::class,
        'format_type' => FormatType::class,
        'question_type' => QuestionType::class,
        'level' => QuestionType::class,
        'is_random' => 'boolean',
        'is_free' => 'boolean',
        'allow_remake' => 'boolean',
        'active' => 'boolean',
        'published_at' => 'datetime',
        'date_from' => 'datetime',
        'date_to' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(QuizOption::class);
    }
}
