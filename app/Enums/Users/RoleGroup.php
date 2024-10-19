<?php

namespace App\Enums\Users;

use App\Traits\EnumCaseToArray;

/**
 *
 */
enum RoleGroup
{
    use EnumCaseToArray;

    case development;
    case admin;

    /**
     * @return string
     */
    public function label(): string
    {
        return self::getLabel($this);
    }

    /**
     * @param RoleGroup $value
     * @return string
     */
    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::development => 'Development',
            default => 'Admin',
        };
    }
}
