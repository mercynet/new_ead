<?php

namespace App\Services\Courses;

use App\Models\Courses\Course;
use App\Services\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 *
 */
class CourseService extends Service
{
    protected readonly Model $model;

    /**
     * @var array|string[]
     */
    protected array $with = [
        'formations',
        'course_modules',
        'lessons',
        'students',
        'instructors',
    ];

    public function __construct()
    {
        $this->model = new Course();
    }

    /**
     * Retrieves the courses based on the given parameters.
     *
     * @param Request|null $request The request object to be used for additional conditions in the query. Defaults to null.
     * @param array|null $fields An array of fields to be selected in the query. Defaults to null.
     * @param array|null $relations An array of relations to eager load in the query. Defaults to null.
     * @param array $where An array of additional where conditions to be applied in the query. Defaults to an empty array.
     * @param int $paginate The number of items to be displayed per page. Defaults to 20.
     * @return LengthAwarePaginator|Collection|null The paginated items or a collection of settings or null if pagination is omitted.
     */
    public function courses(
        ?Request $request = null,
        ?array $fields = null,
        ?array $relations = null,
        array $where = [],
        int $paginate = 20
    ): LengthAwarePaginator|Collection|null {
        $builder = $this->courseBuilder($request, $fields, $relations, $where);
        if ($paginate > 0) {
            return $builder->paginate($paginate);
        }

        return $builder->get();
    }

    /**
     * Builds and returns a query builder instance based on the given parameters.
     *
     * @param Request|null $request The request object to be used for additional conditions in the query. Defaults to null.
     * @param array|null $fields An array of fields to be selected in the query. Defaults to null.
     * @param array|null $relations An array of relations to eager load in the query. Defaults to null.
     * @param array $where An array of additional where conditions to be applied in the query. Defaults to an empty array.
     * @return Builder The query builder instance.
     */
    public function courseBuilder(?Request $request = null, ?array $fields = null, ?array $relations = null, array $where = []): Builder
    {
        if ($relations !== null) {
            $this->with = array_merge($this->with, $relations);
        }

        return $this->builder($fields, $where);
    }

    /**
     * Retrieves and returns the first instance of a Course based on the given parameters.
     *
     * @return Course|null The first instance of a Course, or null if no matches found.
     */
    public function course(Course $course): ?Course
    {
        return $course->fresh();
    }

    /**
     * @param array $data
     * @return Course
     */
    public function create(array $data): Course
    {
        return Course::create($data);
    }

    /**
     * Updates the specified Course instance with the provided data.
     *
     * @param array $data The data to update the Course instance with.
     * @param Course $course The Course instance to be updated.
     * @return Course The updated Course instance.
     */
    public function update(array $data, Course $course): Course
    {
        $course->update($data);
        return $course;
    }

    /**
     * @param Course $course
     * @return Course
     */
    public function enable(Course $course): Course
    {
        $course->update(['active' => true]);
        return $course;
    }

    /**
     * @param Course $course
     * @return Course
     */
    public function disable(Course $course): Course
    {
        $course->update(['active' => false]);
        return $course;
    }

    /**
     * Deletes the specified Course instance.
     *
     * @param Course $course The Course instance to be deleted.
     * @return void
     */
    public function delete(Course $course): void
    {
        $course->delete();
    }
}
