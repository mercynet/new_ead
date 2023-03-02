<?php

namespace App\Enums\Quizzes;

use App\Enums\ToArray;

enum ExibitionType
{
    use ToArray;

    case single_question;
    case single_page;
    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::single_question => trans('quizzes.enums.exibition_types.single_question'),
            default => trans('quizzes.enums.exibition_types.single_page')
        };
    }
}
