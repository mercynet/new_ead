<?php

namespace App\Enums\Quizzes;

use App\Traits\EnumCaseToArray;

/**
 *
 */
enum Level
{
    use EnumCaseToArray;
    case begginner;
    case intermediate;
    case advanced;

    /**
     * @param Level $value
     * @return string
     */
    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::intermediate => trans('quizzes.enums.levels.intermediate'),
            self::advanced => trans('quizzes.enums.levels.advanced'),
            default => trans('quizzes.enums.levels.begginner'),
        };
    }
}
