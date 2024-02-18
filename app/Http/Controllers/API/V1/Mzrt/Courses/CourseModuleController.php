<?php

namespace App\Http\Controllers\API\V1\Mzrt\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\StoreCourseModuleRequest;
use App\Http\Requests\Mzrt\UpdateCourseModuleRequest;
use App\Http\Resources\Mzrt\Courses\CourseResource;
use App\Models\Courses\CourseModule;
use App\Services\Courses\CourseService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CourseModuleController extends Controller
{
    public function __construct(private readonly CourseService $courseService)
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return CourseResource::collection($this->courseService->courses($request));
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param StoreCourseModuleRequest $request
     * @return Response
     */
    public function store(StoreCourseModuleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param CourseModule $courseModule
     * @return Response
     */
    public function show(CourseModule $courseModule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCourseModuleRequest $request
     * @param CourseModule $courseModule
     * @return Response
     */
    public function update(UpdateCourseModuleRequest $request, CourseModule $courseModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CourseModule $courseModule
     * @return Response
     */
    public function destroy(CourseModule $courseModule)
    {
        //
    }
}
