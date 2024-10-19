<?php

namespace App\Services\Courses;

use App\Strategies\Lessons\Display\LessonDisplayStrategyFactory;
use App\UseCases\Mzrt\Courses\Lessons\CreateLessonUseCase;
use App\UseCases\Mzrt\Courses\Lessons\UpdateLessonUseCase;
use App\UseCases\Mzrt\Courses\Lessons\DeleteLessonUseCase;
use App\UseCases\Mzrt\Courses\Lessons\SyncLessonsByModuleUseCase;
use App\Models\Courses\CourseModule;
use App\Models\Courses\Lesson;
use App\Services\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class LessonService extends Service
{
    public function __construct(
        private readonly CreateLessonUseCase $createLessonUseCase,
        private readonly UpdateLessonUseCase $updateLessonUseCase,
        private readonly DeleteLessonUseCase $deleteLessonUseCase,
        private readonly SyncLessonsByModuleUseCase $syncLessonsByModuleUseCase
    ) {
        //
    }

    public function lessons(
        ?Request $request = null,
        ?array $fields = null,
        ?array $relations = null,
        array $where = [],
        int $paginate = 20
    ): LengthAwarePaginator|Collection|null {
        $builder = $this->lessonBuilder($request, $fields, $relations, $where);
        if ($paginate > 0) {
            return $builder->paginate($paginate);
        }

        return $builder->get();
    }

    public function lessonBuilder(?Request $request = null, ?array $fields = null, ?array $relations = null, array $where = []): Builder
    {
        if ($relations !== null) {
            $this->with = array_merge($this->with, $relations);
        }

        return $this->builder($fields, $where);
    }

    public function lesson(Lesson $lesson): ?Lesson
    {
        return $lesson->fresh();
    }

    public function renderLesson(Lesson $lesson): string
    {
        $strategy = LessonDisplayStrategyFactory::make($lesson->type);
        return $strategy->render($lesson);
    }

    public function create(CourseModule $module, array $data): Lesson
    {
        return $this->createLessonUseCase->execute($module, $data);
    }

    public function update(Lesson $lesson, array $data): Lesson
    {
        return $this->updateLessonUseCase->execute($lesson, $data);
    }

    public function delete(Lesson $lesson): void
    {
        $this->deleteLessonUseCase->execute($lesson);
    }

    public function syncByModule(array $lessons, CourseModule $module): void
    {
        $this->syncLessonsByModuleUseCase->execute($lessons, $module);
    }
}
