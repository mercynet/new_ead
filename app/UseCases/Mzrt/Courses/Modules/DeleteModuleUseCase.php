<?php

namespace App\UseCases\Mzrt\Courses\Modules;

use App\Models\Courses\CourseModule;

class DeleteModuleUseCase implements ModuleUseCaseInterface
{
    public function execute(...$params): void
    {
        [$module] = $params;
        $module->delete();
    }
}
