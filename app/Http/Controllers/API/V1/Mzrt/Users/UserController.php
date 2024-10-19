<?php

namespace App\Http\Controllers\API\V1\Mzrt\Users;

use App\Exceptions\InvalidUploadException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\Users\StoreUserRequest;
use App\Http\Requests\Mzrt\Users\UpdateUserRequest;
use App\Http\Resources\Mzrt\Users\UserResource;
use App\Models\Users\User;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Mozart
 *
 * @subgroup Users
 * @subgroupDescription This controller handles all operations related to user management, including listing users, creating new users, updating existing users, enabling/disabling users, and deleting users.
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     *
     * @param UserService $userService Service for user operations
     */
    public function __construct(private readonly UserService $userService)
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * List all users
     *
     * @param Request $request HTTP request object
     * @return AnonymousResourceCollection Collection of user resources
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection($this->userService->toPaginate());
    }

    /**
     * Store a new user
     *
     * @param StoreUserRequest $request HTTP request with user data
     * @return UserResource Resource of the created user
     * @throws InvalidUploadException If the upload is invalid
     */
    public function store(StoreUserRequest $request): UserResource
    {
        $user = $this->userService->create($request->validated());
        return UserResource::make($user);
    }

    /**
     * Returns a specific user
     *
     * @param User $user User model instance
     * @return UserResource|null Resource of the specified user or null
     */
    public function show(User $user): ?UserResource
    {
        return UserResource::make($this->userService->find($user->id));
    }

    /**
     * Updates a specific user
     *
     * @param UpdateUserRequest $request HTTP request with updated user data
     * @param User $user User model instance
     * @return UserResource Resource of the updated user
     * @throws InvalidUploadException
     */
    public function update(UpdateUserRequest $request, User $user): UserResource
    {
        $user = $this->userService->update($user, $request->validated());
        return UserResource::make($user);
    }

    /**
     * Enable a user
     *
     * @param User $user User model instance
     * @return UserResource Resource of the enabled user
     */
    public function enable(User $user): UserResource
    {
        return UserResource::make($this->userService->enable($user));
    }

    /**
     * Disable a user
     *
     * @param User $user User model instance
     * @return UserResource Resource of the disabled user
     */
    public function disable(User $user): UserResource
    {
        return UserResource::make($this->userService->disable($user));
    }

    /**
     * Delete a user
     *
     * @param User $user User model instance
     * @return AnonymousResourceCollection Collection of remaining user resources
     */
    public function destroy(User $user): AnonymousResourceCollection
    {
        $user->roles()->detach();
        $user->delete();
        return UserResource::collection($this->userService->toPaginate());
    }
}
