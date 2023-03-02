<?php

namespace App\Enums\Users;

use App\Enums\ToArray;

enum PhoneNumberType
{
    use ToArray;

    case mobile;
    case phone;

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::mobile => trans('phone_numbers.enums.types.mobile'),
            default => trans('phone_numbers.enums.types.phone'),
        };
    }
}
