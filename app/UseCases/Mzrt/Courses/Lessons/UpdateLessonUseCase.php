<?php

namespace App\UseCases\Mzrt\Courses\Lessons;

use App\Models\Courses\Lesson;

class UpdateLessonUseCase implements LessonUseCaseInterface
{
    public function execute(...$params): Lesson
    {
        [$lesson, $data] = $params;
        $lesson->update($data);
        return $lesson;
    }
}
