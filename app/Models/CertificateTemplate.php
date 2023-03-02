<?php

namespace App\Models;

use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class CertificateTemplate extends Model
{
    use HasFactory, SoftDeletes, HasLog;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'position_x',
        'position_y',
        'font_size',
        'text_color',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function certificados(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }
}
