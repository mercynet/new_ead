<?php

namespace App\Enums\Users;

use App\Traits\EnumCaseToArray;

enum Gender
{
    use EnumCaseToArray;
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

    public function label(): string
    {
        return self::getLabel($this);
    }
}
