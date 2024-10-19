<?php

namespace App\UseCases\Mzrt\Courses\Lessons;

use App\Models\Courses\CourseModule;
use App\Models\Courses\Lesson;

class SyncLessonsByModuleUseCase implements LessonUseCaseInterface
{
    public function execute(...$params): void
    {
        [$lessons, $module] = $params;
        $toCreate = [];
        foreach ($lessons as $lesson) {
            $toCreate[] = [
                'module_id' => $module->id,
                'order' => $lesson['order'],
                'name' => $lesson['name'],
                'slug' => $lesson['slug'],
                'video_type' => $lesson['video_type'],
                'video_path' => $lesson['video_path'],
                'video_duration' => $lesson['video_duration'],
                'video_downloadable' => $lesson['video_downloadable'],
                'summary' => $lesson['summary'],
                'description' => $lesson['description'],
                'image_featured' => $lesson['image_featured'],
                'meta_description' => $lesson['meta_description'],
                'meta_keywords' => $lesson['meta_keywords'],
                'is_free' => $lesson['is_free'],
                'is_commentable' => $lesson['is_commentable'],
                'active' => $lesson['active'],
                'started_at' => $lesson['started_at'],
                'ended_at' => $lesson['ended_at'],
            ];
        }
        Lesson::upsert($toCreate, ['module_id', 'slug']);
    }
}
