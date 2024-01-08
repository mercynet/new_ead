<?php

namespace App\Http\Controllers\API\V1\Mzrt\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\Users\Students\StoreStudentRequest;
use App\Http\Requests\Mzrt\Users\Students\StudentPointRequest;
use App\Http\Requests\Mzrt\Users\Students\UpdateStudentRequest;
use App\Http\Resources\Mzrt\Users\StudentResource;
use App\Models\Users\Student;
use App\Models\Users\User;
use App\Services\Users\StudentService;
use Illuminate\Http\Response;

/**
 * @group Mozart
 *
 * @subgroup Users
 * @subgroupDescription APIs for Students
 */
class StudentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Student::class, 'student');
    }

    /**
     * Store a newly created student for an existent user.
     *
     * @param StoreStudentRequest $request
     * @param User $user
     * @return Response
     */
    public function store(StoreStudentRequest $request, User $user)
    {
        return StudentResource::make(StudentService::create($request->validated(), $user));
    }

    /**
     * Update the specified student from an existent user.
     *
     * @param UpdateStudentRequest $request
     * @param User $user
     * @return Response
     */
    public function update(UpdateStudentRequest $request, User $user)
    {
        return StudentResource::make(StudentService::update($request->validated(), $user));
    }

    /**
     * Increase the student's point
     *
     * @param StudentPointRequest $request
     * @param User $user
     * @return StudentResource
     */
    public function increasePoints(StudentPointRequest $request, User $user)
    {
        StudentService::increasePoints($request->validated()['points'], $user);
        return StudentResource::make(StudentService::getByUser($user));
    }

    /**
     * Decrease the student's point
     *
     * @param StudentPointRequest $request
     * @param User $user
     * @return StudentResource
     */
    public function decreasePoints(StudentPointRequest $request, User $user)
    {
        StudentService::decreasePoints($request->validated()['points'], $user);
        return StudentResource::make(StudentService::getByUser($user));
    }
}
