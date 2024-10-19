<?php

namespace App\Providers\Mzrt\Modules\CourseManagement;

use App\UseCases\Mzrt\Courses\Modules\CreateModuleUseCase;
use App\UseCases\Mzrt\Courses\Modules\DeleteModuleUseCase;
use App\UseCases\Mzrt\Courses\Modules\ModuleUseCaseInterface;
use App\UseCases\Mzrt\Courses\Modules\SyncModulesByCourseUseCase;
use App\UseCases\Mzrt\Courses\Modules\UpdateModuleUseCase;
use Illuminate\Support\ServiceProvider;

class CourseModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CreateModuleUseCase::class, function ($app) {
            return new CreateModuleUseCase();
        });

        $this->app->bind(UpdateModuleUseCase::class, function ($app) {
            return new UpdateModuleUseCase();
        });

        $this->app->bind(DeleteModuleUseCase::class, function ($app) {
            return new DeleteModuleUseCase();
        });

        $this->app->bind(SyncModulesByCourseUseCase::class, function ($app) {
            return new SyncModulesByCourseUseCase();
        });
    }

    public function boot(): void
    {
        //
    }
}
