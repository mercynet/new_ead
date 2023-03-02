<?php

namespace App\Models;

use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 */
class Certificate extends Model
{
    use HasFactory, HasLog, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'certificate_template_id',
        'user_id',
        'grade',
        'file',
        'model_type',
        'model_id',
    ];

    /**
     * @return BelongsTo
     */
    public function certificate_template(): BelongsTo
    {
        return $this->belongsTo(CertificateTemplate::class);
    }

    /**
     * @return MorphToMany
     */
    public function courses(): MorphToMany
    {
        return $this->morphedByMany(Course::class, 'model');
    }

    /**
     * @return MorphToMany
     */
    public function formations(): MorphToMany
    {
        return $this->morphedByMany(Formation::class, 'model');
    }
}
