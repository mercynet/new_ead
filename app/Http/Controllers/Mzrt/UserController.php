<?php

namespace App\Http\Controllers\Mzrt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\StoreUserRequest;
use App\Http\Resources\Mzrt\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 *
 */
class UserController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return UserResource::collection(User::paginate(20))->additional(['success' => true]);
    }

    /**
     * @param StoreUserRequest $request
     * @return void
     */
    public function store(StoreUserRequest $request)
    {
        return UserResource::make(UserService::register($request->validated()));
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
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function update(Request $request, User $user)
    {
    }

    /**
     * @param User $user
     * @return void
     */
    public function destroy(User $user)
    {
    }
}
