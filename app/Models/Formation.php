<?php

namespace App\Models;

use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formation extends Model
{
    use HasFactory, SoftDeletes, HasLog;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'fifo',
        'active',
    ];

    protected $casts = [
        'fifo' => 'boolean',
        'active' => 'boolean',
    ];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }
}
