<?php

namespace App\Providers\Mzrt\Modules\CourseManagement;

use App\UseCases\Mzrt\Courses\Lessons\CreateLessonUseCase;
use App\UseCases\Mzrt\Courses\Lessons\UpdateLessonUseCase;
use App\UseCases\Mzrt\Courses\Lessons\DeleteLessonUseCase;
use App\UseCases\Mzrt\Courses\Lessons\SyncLessonsByModuleUseCase;
use Illuminate\Support\ServiceProvider;

class LessonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CreateLessonUseCase::class, function ($app) {
            return new CreateLessonUseCase();
        });

        $this->app->bind(UpdateLessonUseCase::class, function ($app) {
            return new UpdateLessonUseCase();
        });

        $this->app->bind(DeleteLessonUseCase::class, function ($app) {
            return new DeleteLessonUseCase();
        });

        $this->app->bind(SyncLessonsByModuleUseCase::class, function ($app) {
            return new SyncLessonsByModuleUseCase();
        });
    }

    public function boot(): void
    {
        //
    }
}
