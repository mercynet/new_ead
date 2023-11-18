<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * @Authenticated
 */
class AuthController
{
    /**
     * @param LoginRequest $request
     * @return LoginResource
     * @unauthenticated
     */
    public function login(LoginRequest $request)
    {
        $credentials = array_merge($request->validated(), ['active' => 1]);
        if (!Auth::attempt($credentials, $request->remember ?? false)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
        $request->session()->regenerate();
        return LoginResource::make(auth()->user()->loadMissing(['roles.permissions:id,name']));
    }

    /**
     * @param RegisterRequest $request
     * @return LoginResource|null
     * @unauthenticated
     */
    public function register(RegisterRequest $request): ?LoginResource
    {
        $user = UserService::register($request->validated());
        Auth::login($user);
        return LoginResource::make($user->loadMissing('roles.permissions:id,name'));
    }

    /**
     * @param Request $request
     * @return array|LoginResource
     */
    public function checkToken(Request $request): array|LoginResource
    {
        if(!auth(getGuardName())->check()) {
            $this->logout($request);
            return ['success' => false];
        }
        return LoginResource::make(UserService::getById(auth(getGuardName())->id()));
    }

    /**
     * @param Request $request
     * @return true[]
     */
    public function logout(Request $request): array
    {
        $request->session()->flush();
        auth()->user()->tokens()->delete();
        return ['success' => true];
    }
}
