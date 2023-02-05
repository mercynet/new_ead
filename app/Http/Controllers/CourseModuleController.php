<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseModuleRequest;
use App\Http\Requests\UpdateCourseModuleRequest;
use App\Models\CourseModule;

class CourseModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseModuleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseModuleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseModule  $courseModule
     * @return \Illuminate\Http\Response
     */
    public function show(CourseModule $courseModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseModule  $courseModule
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseModule $courseModule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseModuleRequest  $request
     * @param  \App\Models\CourseModule  $courseModule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseModuleRequest $request, CourseModule $courseModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseModule  $courseModule
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseModule $courseModule)
    {
        //
    }
}
