<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Price extends Model
{
    protected $fillable = ['priceable_id', 'priceable_type', 'price', 'region'];

    public function priceable(): MorphTo
    {
        return $this->morphTo();
    }
}
