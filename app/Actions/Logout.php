<?php

namespace App\Actions;

use App\Models\Users\User;
use Illuminate\Http\Request;

class Logout
{
    public function __invoke(Request $request, User $user): array
    {
        $request->session()->flush();
        $user->tokens()->delete();
        return ['success' => true];
    }
}
