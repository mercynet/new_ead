<?php

namespace App\UseCases\Mzrt\Courses\Lessons;

use App\Models\Courses\CourseModule;
use App\Models\Courses\Lesson;

class CreateLessonUseCase implements LessonUseCaseInterface
{
    public function execute(...$params): Lesson
    {
        [$module, $data] = $params;
        $data['module_id'] = $module->id;
        return Lesson::create($data);
    }
}
