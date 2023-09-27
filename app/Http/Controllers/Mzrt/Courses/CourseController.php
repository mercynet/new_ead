<?php

namespace App\Http\Controllers\Mzrt\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\StoreCourseRequest;
use App\Http\Requests\Mzrt\UpdateCourseRequest;
use App\Http\Resources\Mzrt\Courses\CourseResource;
use App\Models\Course;
use App\Services\Courses\CourseService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

/**
 * @group Mozart
 *
 * @subgroup Courses
 * @subgroupDescription Courses general management
 *
 */
class CourseController extends Controller
{
    /**
     * @param CourseService $courseService
     */
    public function __construct(private readonly CourseService $courseService)
    {
        $this->authorizeResource(Course::class, 'course');
    }

    /**
     * Display a listing of the courses.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return CourseResource::collection($this->courseService->courses($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCourseRequest $request
     * @return Response
     */
    public function store(StoreCourseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCourseRequest $request
     * @param Course $course
     * @return Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
