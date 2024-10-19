<?php

// tests/Unit/ModuleServiceTest.php

use App\Models\Courses\Course;
use App\Models\Courses\CourseModule;
use App\Models\Language;
use App\Services\Courses\ModuleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

beforeEach(function () {
    $this->moduleService = new ModuleService();
});

it('retrieves all course modules', function () {
    CourseModule::factory()->count(5)->create();

    $result = $this->moduleService->modules();

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($result->count())->toBe(5);
});

it('creates a new course module', function () {
    $course = Course::factory()->create();
    $language = Language::factory()->create();
    $name = 'Test Module';
    $slug = 'test-module';

    $module = $this->moduleService->create($course, $language, $name, $slug);

    expect($module)->toBeInstanceOf(CourseModule::class)
        ->and($module->name)->toBe($name)
        ->and($module->slug)->toBe($slug);
});

it('updates a course module', function () {
    $module = CourseModule::factory()->create();
    $language = Language::factory()->create();
    $name = 'Updated Module';
    $slug = 'updated-module';

    $updatedModule = $this->moduleService->update($language, $name, $slug, $module);

    expect($updatedModule->name)->toBe($name)
        ->and($updatedModule->slug)->toBe($slug);
});

it('deletes a course module', function () {
    $module = CourseModule::factory()->create();

    $this->moduleService->delete($module);

    expect(CourseModule::find($module->id))->toBeNull();
});

it('syncs modules by course', function () {
    $course = Course::factory()->create();
    $modules = [
        ['language_id' => 1, 'name' => 'Module 1', 'slug' => 'module-1'],
        ['language_id' => 2, 'name' => 'Module 2', 'slug' => 'module-2'],
    ];

    $this->moduleService->syncByCourse($modules, $course);

    expect($course->modules()->count())->toBe(2);
});
it('retrieves paginated course modules', function () {
    CourseModule::factory()->count(50)->create();

    $result = $this->moduleService->all(null, null, null, [], 10);

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class)
        ->and($result->perPage())->toBe(10)
        ->and($result->total())->toBe(50);
});
