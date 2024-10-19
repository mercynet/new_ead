<?php

namespace App\Enums\Plans;

use App\Traits\EnumCaseToArray;

enum ServiceType
{
    use EnumCaseToArray;

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
