<?php

namespace App\Http\Controllers\Mzrt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\StoreUserRequest;
use App\Http\Requests\Mzrt\UpdateUserRequest;
use App\Http\Resources\Mzrt\UserResource;
use App\Models\User;
use App\Services\Users\UserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Mzrt
 *
 * @subgroup Users
 * @subgroupDescription List of generic users
 */
class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * List all users
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return UserResource::collection(UserService::getAll(relations: [
            'roles.permissions:id,name',
            'userInfo' => ['timezone'],
        ]))->additional(['success' => true]);
    }

    /**
     * @param StoreUserRequest $request
     * @return void
     */
    public function store(StoreUserRequest $request)
    {
        $user = UserService::create($request->validated());
        return UserResource::make(UserService::getById(id: $user->id, relations: [
            'roles.permissions:id,name',
            'userInfo' => ['timezone'],
        ]));
    }

    /**
     * @param User $user
     * @return UserResource|null
     */
    public function show(User $user): ?UserResource
    {
        return UserResource::make($user->loadMissing(['roles.permissions']));
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return void
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        return UserResource::make(UserService::update($user, $request->validated()));
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
        return UserResource::collection(User::paginate(20))->additional(['success' => true]);
    }
}
