<?php

namespace App\Enums;

enum CourseLevel
{
    case begginner;
    case intermediate;
    case advanced;
    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::intermediate => 'Intermediário',
            self::advanced => 'Avançado',
            default => 'Iniciante'
        };
    }

    public static function toArray(): array
    {
        return collect(self::cases())->map(fn($case) => $case->name)->toArray();
    }
}
