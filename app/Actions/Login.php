<?php

namespace App\Actions;

use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 *
 */
class Login
{
    /**
     * @param Request $request
     * @return User|null
     */
    public function __invoke(Request $request): ?User
    {
        $credentials = array_merge($request->only('email', 'password'), ['active' => 1]);
        if (!Auth::attempt($credentials, $request->remember ?? false)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
        return User::with(['roles.permissions:id,name'])->find(auth()->id());
    }
}
