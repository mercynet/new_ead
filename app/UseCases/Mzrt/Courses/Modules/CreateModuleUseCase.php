<?php

namespace App\UseCases\Mzrt\Courses\Modules;

use App\Models\Courses\Course;
use App\Models\Courses\CourseModule;
use App\Models\Language;

class CreateModuleUseCase implements ModuleUseCaseInterface
{

    public function execute(...$params): CourseModule
    {
        [$course, $language, $name, $slug] = $params;

        return CourseModule::create([
            'course_id' => $course->id,
            'language_id' => $language->id,
            'name' => $name,
            'slug' => $slug,
        ]);
    }
}
