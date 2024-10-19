<?php

namespace App\Enums\Users;

use App\Traits\EnumCaseToArray;

enum Role
{
    use EnumCaseToArray;

    case development;
    case superuser;
    case admin;
    case student;
    case instructor;


    /**
     * @return string
     */
    public function label(): string
    {
        return self::getLabel($this);
    }

    /**
     * @param Role $value
     * @return string
     */
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
