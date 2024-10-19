<?php

namespace App\UseCases\Mzrt\Courses\Modules;

use App\Models\Courses\Course;
use App\Models\Courses\CourseModule;

class SyncModulesByCourseUseCase implements ModuleUseCaseInterface
{
    /**
     * @throws \Exception
     */
    public function execute(...$params): void
    {
        [$modules, $course] = $params;
        $toCreate = [];
        foreach ($modules as $module) {
            $toCreate[] = [
                'course_id' => $course->id,
                'language_id' => $module['language_id'],
                'name' => $module['name'],
                'slug' => $module['slug'],
            ];
        }
        CourseModule::update($toCreate, ['course_id', 'language_id']);
    }
}
