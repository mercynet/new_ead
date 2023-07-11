<?php

namespace App\Enums;

enum Active
{
    use ToArray;

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
