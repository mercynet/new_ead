<?php

namespace App\Enums\Plans;

use App\Enums\ToArray;

enum ServiceType
{
    use ToArray;

    case relationship;
    case count;

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::relationship => trans('plans.enums.services.types.relationship'),
            default => trans('plans.enums.services.types.count')
        };
    }
}
