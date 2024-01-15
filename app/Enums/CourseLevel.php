<?php

namespace App\Enums;

enum CourseLevel
{
    use ToArray;
    case beginner;
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
}
