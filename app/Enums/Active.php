<?php

namespace App\Enums;

use App\Traits\EnumCaseToArray;

enum Active
{
    use EnumCaseToArray;

    case active;
    case inactive;

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::active => 'Ativo',
            default => 'Inativo'
        };
    }
}
