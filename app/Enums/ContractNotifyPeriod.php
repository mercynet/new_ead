<?php

namespace App\Enums;

use App\Traits\EnumCaseToArray;

enum ContractNotifyPeriod
{
    use EnumCaseToArray;

    case days;
    case weeks;
    case months;

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::days => trans('contracts.enums.notify_periods.days'),
            self::weeks => trans('contracts.enums.notify_periods.weeks'),
            default => trans('contracts.enums.notify_periods.months')
        };
    }
}
