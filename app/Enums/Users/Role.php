<?php

namespace App\Enums\Users;

use App\Enums\ToArray;

enum Role
{
    use ToArray;
    case development;
    case superuser;
    case admin;
    case student;
    case instructor;

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::development => 'Development',
            self::superuser => 'Superuser',
            self::admin => 'Admin',
            self::student => 'Student',
            default => 'Instructor',
        };
    }
}
