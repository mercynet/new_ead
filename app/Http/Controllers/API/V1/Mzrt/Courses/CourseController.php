<?php

namespace App\Http\Controllers\API\V1\Mzrt\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\Courses\Courses\CourseRequest;
use App\Http\Resources\Mzrt\Courses\CourseResource;
use App\Models\Courses\Course;
use App\Services\Courses\CourseService;
use App\Services\Courses\ModuleService;
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
     * @param ModuleService $moduleService
     */
    public function __construct(
        private readonly CourseService $courseService,
        private readonly ModuleService $moduleService
    )
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
     * @param CourseRequest $request
     * @return Response
     */
    public function store(CourseRequest $request)
    {
        $data = $request->validated();
        if (isset($data['course_modules'])) {
            $this->moduleService->syncByCourse($data['course_modules'], $course);
        }
        return CourseResource::make($course);
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return CourseResource
     */
    public function show(Course $course): CourseResource
    {
        $course = $this->courseService->course($course);
        return CourseResource::make($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseRequest $request
     * @param Course $course
     * @return CourseResource
     */
    public function update(CourseRequest $request, Course $course): CourseResource
    {
        $course = $this->courseService->update($request->validated(), $course);
        return CourseResource::make($course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return Response
     */
    public function destroy(Course $course): Response
    {
        $this->courseService->delete($course);
        return response()->noContent();
    }
}
