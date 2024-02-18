<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait Image
{
    protected string $placeholder = 'storage/blank.png';

    /**
     * @return Attribute
     */
    public function imageFeatured(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                if ($value && str_contains($value, $this->placeholder)) {
                    return asset("storage/" . str_replace(config('app.url') . "/storage/", '', $value));
                }
                return asset($this->placeholder);
            },
        );
    }

    public function imageCover(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                if ($value && str_contains($value, $this->placeholder)) {
                    return asset("storage/" . str_replace(config('app.url') . "/storage/", '', $value));
                }
                return asset($this->placeholder);
            },
        );
    }

    public function avatar(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                if ($value && str_contains($value, $this->placeholder)) {
                    return asset("storage/" . str_replace(config('app.url') . "/storage/", '', $value));
                }
                return asset($this->placeholder);
            },
        );
    }
}
