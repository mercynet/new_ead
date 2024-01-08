<?php

namespace App\Http\Controllers\API\V1\Mzrt\Users;

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
    private array $additionalReturn = ['success' => true];

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
        return UserResource::collection(UserService::getAll())->additional($this->additionalReturn);
    }

    /**
     * Store a new user
     * @param StoreUserRequest $request
     * @return AnonymousResourceCollection
     */
    public function store(StoreUserRequest $request): AnonymousResourceCollection
    {
        UserService::create($request->validated());
        return UserResource::collection(UserService::toPaginate())->additional($this->additionalReturn);
    }

    /**
     * Returns a specific user
     * @param User $user
     * @return UserResource|null
     */
    public function show(User $user): ?UserResource
    {
        return UserResource::make(UserService::getById($user->id));
    }

    /**
     * Updates a specific user
     * @param UpdateUserRequest $request
     * @param User $user
     * @return AnonymousResourceCollection
     */
    public function update(UpdateUserRequest $request, User $user): AnonymousResourceCollection
    {
        UserService::update($user, $request->validated());
        return UserResource::collection(UserService::toPaginate())->additional($this->additionalReturn);
    }

    /**
     * @param User $user
     * @return void
     */
    public function enable(User $user)
    {
        return UserResource::make(UserService::update($user, ['active' => true]));
    }

    /**
     * @param User $user
     * @return void
     */
    public function disable(User $user)
    {
        return UserResource::make(UserService::update($user, ['active' => false]));
    }

    /**
     * @param User $user
     * @return AnonymousResourceCollection
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return UserResource::collection(UserService::toPaginate())->additional($this->additionalReturn);
    }
}
