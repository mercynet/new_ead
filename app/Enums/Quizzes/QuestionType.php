<?php

namespace App\Enums\Quizzes;

use App\Enums\ToArray;

enum QuestionType
{
    use ToArray;

    case single;
    case multiple;
    case sum;
    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::multiple => trans('quizzes.enums.question_types.multiple_answer'),
            self::sum => trans('quizzes.enums.question_types.sum_answer'),
            default => trans('quizzes.enums.question_types.single_answer'),
        };
    }
}
