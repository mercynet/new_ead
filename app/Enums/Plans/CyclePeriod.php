<?php

namespace App\Enums\Plans;

use App\Enums\ToArray;

enum CyclePeriod
{
    use ToArray;

    case hours;
    case days;
    case weeks;
    case months;
    case years;

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::hours => trans('plans.enums.cycles.periods.hours'),
            self::days => trans('plans.enums.cycles.periods.days'),
            self::weeks => trans('plans.enums.cycles.periods.weeks'),
            self::months => trans('plans.enums.cycles.periods.months'),
            default => trans('plans.enums.cycles.periods.years')
        };
    }
}
