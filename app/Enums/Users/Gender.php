<?php

namespace App\Enums\Users;

use App\Enums\ToArray;

enum Gender
{
    use ToArray;
    case male;
    case female;
    case both;

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::male => trans('users.gender.male'),
            self::female => trans('users.gender.female'),
            default => trans('general.both'),
        };
    }
}
