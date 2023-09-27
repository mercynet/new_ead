<?php

namespace App\Services\Courses;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use LaravelIdea\Helper\App\Models\_IH_Course_C;
use LaravelIdea\Helper\App\Models\_IH_Course_QB;

/**
 *
 */
class CourseService
{
    /**
     * @param Request $request
     * @return LengthAwarePaginator|Collection|null
     */
    public function courses(Request $request): Collection|LengthAwarePaginator|null
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
            ->with(['formations', 'modules', 'language', 'lessons', 'level_description']);
        if(!empty($where)) {
            $courses->where($where);
        }
        return $courses;
    }
}
