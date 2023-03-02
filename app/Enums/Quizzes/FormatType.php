<?php

namespace App\Enums\Quizzes;

use App\Enums\ToArray;

enum FormatType
{
    use ToArray;

    case quiz;
    case test;
    public static function getLabel(self $value): array
    {
        return match ($value) {
            self::quiz => [
                'name' => trans('quizzes.enums.format_types.quiz.name'),
                'description' => trans('quizzes.enums.format_types.quiz.description')
            ],
            default => [
                'name' => trans('quizzes.enums.format_types.test.name'),
                'description' => trans('quizzes.enums.format_types.test.description')
            ]
        };
    }
}
