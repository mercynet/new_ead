<?php

namespace App\Enums\Users;

use App\Traits\EnumCaseToArray;

enum PhoneNumberType
{
    use EnumCaseToArray;

    case mobile;
    case phone;

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::mobile => trans('phone_numbers.enums.types.mobile'),
            default => trans('phone_numbers.enums.types.phone'),
        };
    }
    public function label(): string
    {
        return self::getLabel($this);
    }
}
