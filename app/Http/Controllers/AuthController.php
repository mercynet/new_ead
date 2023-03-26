<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 *
 */
class AuthController
{
    /**
     * @param LoginRequest $request
     * @return LoginResource
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
        return LoginResource::make(auth()->user()->loadMissing(['roles.permissions']));
    }

    /**
     * @param RegisterRequest $request
     * @return LoginResource|null
     */
    public function register(RegisterRequest $request): ?LoginResource
    {
        $user = UserService::register($request->validated());
        Auth::login($user);
        return LoginResource::make($user->loadMissing('roles.permissions'));
    }

    /**
     * @param Request $request
     * @return array|LoginResource
     */
    public function checkToken(Request $request): array|LoginResource
    {
        if(!$request->bearerToken()) {
            $this->logout($request);
            return ['success' => false];
        }

        return LoginResource::make(User::with(['userInstallations', 'roles.permissions'])->find(auth()->id()));
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
