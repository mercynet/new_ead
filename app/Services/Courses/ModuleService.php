<?php

namespace App\Services\Courses;

use App\UseCases\Mzrt\Courses\Modules\CreateModuleUseCase;
use App\UseCases\Mzrt\Courses\Modules\DeleteModuleUseCase;
use App\UseCases\Mzrt\Courses\Modules\SyncModulesByCourseUseCase;
use App\UseCases\Mzrt\Courses\Modules\UpdateModuleUseCase;
use App\Models\Courses\Course;
use App\Models\Courses\CourseModule;
use App\Models\Language;
use App\Services\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ModuleService extends Service
{
    public function __construct(
        private readonly CreateModuleUseCase $createModuleUseCase,
        private readonly UpdateModuleUseCase $updateModuleUseCase,
        private readonly DeleteModuleUseCase $deleteModuleUseCase,
        private readonly SyncModulesByCourseUseCase $syncModulesByCourseUseCase
    ) {
        //
    }

    public function modules(
        ?Request $request = null,
        ?array $fields = null,
        ?array $relations = null,
        array $where = [],
        int $paginate = 20
    ): LengthAwarePaginator|Collection|null {
        $builder = $this->moduleBuilder($request, $fields, $relations, $where);
        if ($paginate > 0) {
            return $builder->paginate($paginate);
        }

        return $builder->get();
    }

    public function moduleBuilder(?Request $request = null, ?array $fields = null, ?array $relations = null, array $where = []): Builder
    {
        if ($relations !== null) {
            $this->with = array_merge($this->with, $relations);
        }

        return $this->builder($fields, $where);
    }

    public function module(CourseModule $module): ?CourseModule
    {
        return $module->fresh();
    }

    public function create(Course $course, Language $language, string $name, string $slug): CourseModule
    {
        return $this->createModuleUseCase->execute($course, $language, $name, $slug);
    }

    public function update(Language $language, string $name, string $slug, CourseModule $module): CourseModule
    {
        return $this->updateModuleUseCase->execute($language, $name, $slug, $module);
    }

    public function delete(CourseModule $module): void
    {
        $this->deleteModuleUseCase->execute($module);
    }

    public function syncByCourse(array $modules, Course $course): void
    {
        $this->syncModulesByCourseUseCase->execute($modules, $course);
    }
}
