<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;

class UserService
{
    /**
     * @param array $userData
     * @return User|null
     */
    public static function register(array $userData): ?User
    {
        $user = User::create($userData);

        if(!empty($userData['roles'])) {
            $roles = Role::where(['name' => $userData['roles']])->get();
            $user->assignRole($roles);
        }

        return $user->loadMissing(['roles.permissions']);
    }
}
