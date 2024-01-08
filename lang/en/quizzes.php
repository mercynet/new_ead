<?php

return [
    'enums' => [
        'format_types' => [
            'quiz' => [
                'name' => 'Quiz',
                'description' => 'It shows the results summary after finish',
            ],
            'test' => [
                'name' => 'Test',
                'description' => 'It does not shows the result summary and it is pre requisite for certificate generation.',
            ],
        ],
        'exhibition_types' => [
            'single_question' => 'Single question',
            'single_page' => 'All questions on same page',
        ],
        'question_types' => [
            'multiple_answer' => 'Multiple answer',
            'sum' => 'Sum answer',
            'single_answer' => 'Single answer',
        ],
        'levels' => [
            'beginner' => 'Beginner',
            'intermediate' => 'Intermediate',
            'advanced' => 'Advanced',
        ]
    ]
];
