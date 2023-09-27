<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 *
 */
trait Price
{
    /**
     * @return Attribute
     */
    public function amount(): Attribute
    {
        return new Attribute(
            get: fn($value) => floatval($value) / 100,
            set: fn($value) => floatval($value) * 100,
        );
    }

    /**
     * @return Attribute
     */
    public function price(): Attribute
    {
        return new Attribute(
            get: fn($value) => floatval($value) / 100,
            set: fn($value) => floatval($value) * 100,
        );
    }

    /**
     * @return Attribute
     */
    public function total(): Attribute
    {
        return new Attribute(
            get: fn($value) => floatval($value) / 100,
            set: fn($value) => floatval($value) * 100,
        );
    }

    /**
     * @return Attribute
     */
    public function discount(): Attribute
    {
        return new Attribute(
            get: fn($value) => floatval($value) / 100,
            set: fn($value) => floatval($value) * 100,
        );
    }

    /**
     * @return Attribute
     */
    public function productPrice(): Attribute
    {
        return new Attribute(
            get: fn($value) => floatval($value) / 100,
            set: fn($value) => floatval($value) * 100,
        );
    }

    /**
     * @return Attribute
     */
    public function productDiscount(): Attribute
    {
        return new Attribute(
            get: fn($value) => floatval($value) / 100,
            set: fn($value) => floatval($value) * 100,
        );
    }

    /**
     * @return Attribute
     */
    public function commission(): Attribute
    {
        return new Attribute(
            get: fn($value) => floatval($value) / 100,
            set: fn($value) => floatval($value) * 100,
        );
    }
}
