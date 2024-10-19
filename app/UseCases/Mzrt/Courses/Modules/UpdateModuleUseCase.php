<?php

namespace App\UseCases\Mzrt\Courses\Modules;

use App\UseCases\UseCaseInterface;
use App\Models\Courses\CourseModule;
use App\Models\Language;

class UpdateModuleUseCase implements ModuleUseCaseInterface
{
    public function execute(...$params): CourseModule
    {
        [$module, $language, $name, $slug] = $params;
        $module->update([
            'language_id' => $language->id,
            'name' => $name,
            'slug' => $slug,
        ]);
        return $module;
    }
}
