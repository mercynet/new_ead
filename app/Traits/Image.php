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
        return $this->imagePlaceholder();
    }

    public function imageCover(): Attribute
    {
        return $this->imagePlaceholder();
    }


    /**
     * @return Attribute
     */
    public function image(): Attribute
    {
        return $this->imagePlaceholder();
    }

    public function avatar(): Attribute
    {
        return $this->imagePlaceholder();
    }

    /**
     * @return Attribute
     */
    private function imagePlaceholder(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                if ($value && !str_contains($value, $this->placeholder)) {
                    return asset("storage/" . str_replace(config('app.url') . "/storage/", '', $value));
                }
                return asset($this->placeholder);
            },
        );
    }
}
