<?php

namespace App\Http\Controllers\API\V1\Mzrt\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\Users\Instructors\StoreInstructorRequest;
use App\Http\Requests\Mzrt\Users\Instructors\UpdateInstructorRequest;
use App\Http\Resources\Mzrt\Users\InstructorResource;
use App\Models\Users\Instructor;
use App\Models\Users\User;
use App\Services\Users\InstructorService;

/**
 * @group Mozart
 *
 * @subgroup Instructors
 * @subgroupDescription Methods for Instructors
 */
class InstructorController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        $this->authorizeResource(Instructor::class, 'instructors');
    }

    /**
     * @return void
     */
    public function index(): void
    {
        abort(404);
    }

    /**
     * Stores the instructors data from a user
     *
     * @param StoreInstructorRequest $request
     * @param User $user
     * @return void
     */
    public function store(StoreInstructorRequest $request, User $user)
    {
        $data = $request->validated();
        InstructorService::create($data, $user);
        return InstructorResource::make(InstructorService::getByUser(user: $user));
    }

    /**
     * Get a specific user with instructor information
     *
     * @param User $user
     * @return InstructorResource|null
     */
    public function show(User $user): ?InstructorResource
    {
        return InstructorResource::make($user->loadMissing(['instructor', 'roles.permissions']));
    }

    /**
     * Updates the instructor information from a user
     *
     * @param UpdateInstructorRequest $request
     * @param User $user
     * @return InstructorResource
     */
    public function update(UpdateInstructorRequest $request, User $user)
    {
        $validated = $request->validated();
        return InstructorResource::make(InstructorService::update($user, $validated));
    }

    /**
     * Enables a user to do instructor functions
     *
     * @param User $user
     * @return void
     */
    public function enable(User $user)
    {
        return InstructorResource::make(InstructorService::update($user, ['active' => true]));
    }

    /**
     * Disables the specified user to do instructor functions
     *
     * @param User $user
     * @return void
     */
    public function disable(User $user)
    {
        return InstructorResource::make(InstructorService::update($user, ['active' => false]));
    }
}
