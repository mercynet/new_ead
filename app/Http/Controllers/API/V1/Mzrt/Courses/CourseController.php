<?php

namespace App\Http\Controllers\API\V1\Mzrt\Courses;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Mzrt\Courses\UpdateCourseRequest;
use App\Http\Requests\Mzrt\Courses\Courses\StoreCourseRequest;
use App\Http\Resources\Mzrt\Courses\CourseResource;
use App\Models\Courses\Course;
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
        return CourseResource::collection($this->courseService->all($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCourseRequest $request
     * @return Response
     */
    public function store(StoreCourseRequest $request)
    {
        $course = $this->courseService->create($request->validated());
        return CourseResource::make($course);
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
