<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @method static inRandomOrder()
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'comment',
        'activated_at',
        'commentable_id',
        'commentable_type'
    ];

    protected $casts = [
        'activated_at' => 'datetime',
    ];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }


    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Comment::class)->with('comments');
    }
}
