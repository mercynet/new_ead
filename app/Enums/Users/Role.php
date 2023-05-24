<?php

namespace App\Enums\Users;

use App\Enums\ToArray;

enum Role
{
    use ToArray;
    case development;
    case superuser;
    case student;
    case instructor;

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::development => trans('roles.name.development'),
            self::superuser => trans('roles.name.superuser'),
            self::student => trans('roles.name.student'),
            default => trans('roles.name.instructor'),
        };
    }
}
