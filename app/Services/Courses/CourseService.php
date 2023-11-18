<?php

namespace App\Services\Courses;

use App\Models\Courses\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 *
 */
class CourseService
{
    /**
     * @param Request $request
     * @return LengthAwarePaginator|Collection|null
     */
    public function all(Request $request): Collection|LengthAwarePaginator|null
    {
        return $request->all == 1 ? $this->courseData()->get() : $this->courseData()->paginate(20);
    }

    /**
     * @param array $where
     * @return Builder
     */
    public function courseData(array $where = []): Builder
    {
        $courses = Course::select([
            'id',
            'language_id',
            'order',
            'name',
            'slug',
            'level',
            'summary',
            'description',
            'pre_requisites',
            'target',
            'image_featured',
            'image_cover',
            'is_fifo',
            'active',
            'meta_description',
            'meta_keywords',
            'price',
            'access_months',
            'started_at',
            'ended_at',
            'created_at',
            'updated_at',
        ])
            ->with([
                'formations',
                'courses_modules',
                'language',
                'lessons',
                'level_description'
            ]);
        if (!empty($where)) {
            $courses->where($where);
        }
        return $courses;
    }

    /**
     * @param array $data
     * @return Course
     */
    public function create(array $data): Course
    {
        return Course::create($data);
    }
}
