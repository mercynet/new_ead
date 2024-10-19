<?php

namespace App\UseCases\Mzrt\Courses\Lessons;

use App\Models\Courses\Lesson;

class DeleteLessonUseCase implements LessonUseCaseInterface
{
    public function execute(...$params): void
    {
        [$lesson] = $params;
        $lesson->delete();
    }
}
