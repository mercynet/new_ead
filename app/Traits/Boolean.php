<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 *
 */
trait Boolean
{
    /**
     * @return Attribute
     */
    public function active(): Attribute
    {
        return new Attribute(
            set: fn ($value) => (int) $value,
        );
    }

    /**
     * @return Attribute
     */
    public function isShowcase(): Attribute
    {
        return new Attribute(
            set: fn ($value) => (int) $value,
        );
    }
}
