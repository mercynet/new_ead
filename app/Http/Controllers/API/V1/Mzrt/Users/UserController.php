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
 * @subgroupDescription List of generic users
 */
class UserController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * List all users
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection((new UserService)->toPaginate());
    }

    /**
     * Store a new user
     * @param StoreUserRequest $request
     * @return UserResource
     * @throws InvalidUploadException
     */
    public function store(StoreUserRequest $request): UserResource
    {
        $user = (new UserService)->create($request->validated());
        return UserResource::make($user);
    }

    /**
     * Returns a specific user
     * @param User $user
     * @return UserResource|null
     */
    public function show(User $user): ?UserResource
    {
        return UserResource::make((new UserService)->find($user->id));
    }

    /**
     * Updates a specific user
     * @param UpdateUserRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = (new UserService)->update($user, $request->validated());
        return UserResource::make($user);
    }

    /**
     * @param User $user
     * @return void
     */
    public function enable(User $user)
    {
        return UserResource::make((new UserService)->disable($user));
    }

    /**
     * @param User $user
     * @return void
     */
    public function disable(User $user)
    {
        return UserResource::make((new UserService)->disable($user));
    }

    /**
     * @param User $user
     * @return AnonymousResourceCollection
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return UserResource::collection((new UserService)->toPaginate());
    }
}
