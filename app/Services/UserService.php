<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 */
class UserService
{
    /**
     * @param int $pages
     * @param array $fields
     * @param array $relations
     * @return Collection|LengthAwarePaginator|null
     */
    public static function getAll(int $pages = 20, array $fields = [], array $relations = []): null|Collection|LengthAwarePaginator
    {
        $users = User::query()->hasRole()->select(!empty($fields) ? $fields : ['*']);
        if(!empty($relations)) {
            $users->with($relations);
        }
        if($pages > 0) {
            return $users->paginate($pages);
        }
        return $users->get();
    }
    /**
     * @param array $userData
     * @return User|null
     */
    public static function register(array $userData): ?User
    {
        $userData['password'] = bcrypt($userData['password']);
        $user = User::create($userData);
        $roles = !empty($userData['roles']) ? Role::where(['name' => $userData['roles']])->get() : Role::where(['name' => 'student'])->first();
        abort_if(!$roles, 401, trans('auth.roles.not-found'));
        $user->assignRole($roles);
        return $user->loadMissing(['roles.permissions']);
    }

    /**
     * @param User $user
     * @param array $userData
     * @return User|null
     */
    public static function update(User $user, array $userData): ?User
    {
        $user->update($userData);

        if(!empty($userData['roles'])) {
            $roles = Role::where(['name' => $userData['roles']])->get();
            $user->assignRole($roles);
        }

        return $user->loadMissing(['roles.permissions']);
    }

    /**
     * @param array $userData
     * @return User
     */
    public static function create(array $userData): User
    {
        $user = User::create($userData);
    }
}
