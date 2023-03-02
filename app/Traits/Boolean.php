<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait Boolean
{
    public function active(): Attribute
    {
        return new Attribute(
            set: fn ($value) => (int) $value,
        );
    }
}
