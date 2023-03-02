<?php

namespace App\Traits;

use Illuminate\Support\Str;

/**
 * @method static creating(\Closure $param)
 */
trait HasUUID
{
    protected static function bootHasUUID(): void
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Overriding default incrementing settings
     *
     * @return bool
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * Overriding default key type
     *
     * @return bool
     */
    public function getKeyType(): string
    {
        return 'string';
    }
}
