<?php

namespace App\Enums\Users;

use App\Enums\ToArray;

enum MeetingType
{
    use ToArray;
    case online;
    case personal;
    case both;

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::online => trans('users.metting-type.online'),
            self::personal => trans('users.metting-type.personal'),
            default => trans('general.both'),
        };
    }
}
