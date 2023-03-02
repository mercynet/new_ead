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
            self::intermediate => trans('courses.enums.levels.intermediate'),
            self::advanced => trans('courses.enums.levels.advanced'),
            default => trans('courses.enums.levels.begginner'),
        };
    }

    public static function toArray(): array
    {
        return collect(self::cases())->map(fn($case) => $case->name)->toArray();
    }
}
