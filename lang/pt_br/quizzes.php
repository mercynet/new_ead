<?php

return [
    'enums' => [
        'format_types' => [
            'quiz' => [
                'name' => 'Questionário',
                'description' => 'Exibe resutados no final',
            ],
            'test' => [
                'name' => 'Teste',
                'description' => 'Não exibe os resultados e é pre-requisito para a emissão do o certificado',
            ],
        ],
        'exhibition_types' => [
            'single_question' => 'Uma questão de cada vez',
            'single_page' => 'Todas as perguntas numa mesma página',
        ],
        'question_types' => [
            'multiple_answer' => 'Resposta múltipla',
            'sum' => 'Somatório',
            'single_answer' => 'Resposta única',
        ],
        'levels' => [
            'beginner' => 'Iniciante',
            'intermediate' => 'Intermediário',
            'advanced' => 'Avançado',
        ]
    ]
];
