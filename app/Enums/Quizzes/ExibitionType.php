<?php

namespace App\Enums\Quizzes;

use App\Traits\EnumCaseToArray;

enum ExibitionType
{
    use EnumCaseToArray;

    case single_question;
    case single_page;
    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::single_question => trans('quizzes.enums.exhibition_types.single_question'),
            default => trans('quizzes.enums.exhibition_types.single_page')
        };
    }
}
