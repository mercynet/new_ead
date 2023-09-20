<?php

namespace App\Http\Controllers\Mzrt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\StoreUserRequest;
use App\Http\Requests\Mzrt\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Student::class, 'student');
    }
   /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return Response
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }
}
