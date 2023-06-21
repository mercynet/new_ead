<?php

namespace App\Services\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 *
 */
class UserService
{
    /**
     * @param Request $request
     * @param int $pages
     * @param array $fields
     * @param array $relations
     * @return Collection|LengthAwarePaginator|null
     */
    public static function getAll(Request $request, int $pages = 20, array $fields = [], array $relations = []): null|Collection|LengthAwarePaginator
    {
        $users = User::query()
            ->hasAdminRole()
            ->select(!empty($fields) ? $fields : ['*'])
            ->with([
                'roles.permissions:id,name',
                'userInfo' => ['timezone'],
                'instructor',
                'student',
                'group',
            ]);
        if (!empty($relations)) {
            $users->load($relations);
        }
        if ($request->roles) {
            $users->whereHas("roles", function ($q) use ($request) {
                if (is_array($request->roles)) {
                    return $q->whereIn("name", $request->roles);
                }
                return $q->where(["name", $request->roles]);
            });
        }
        if ($pages > 0) {
            return $users->paginate($pages);
        }

        return $users->get();
    }

    /**
     * @param int|array $id
     * @param array $fields
     * @param array $relations
     * @return User|null
     */
    public static function getById(int|array $id, array $fields = [], array $relations = []): ?User
    {
        $user = User::query()
            ->hasAdminRole()
            ->select(!empty($fields) ? $fields : ['*']);
        if (!empty($relations)) {
            $user->with($relations);
        }
        return $user->find($id);
    }

    /**
     * @param array $userData
     * @return User|null
     */
    public static function register(array $userData): ?User
    {
        $roles = !empty($userData['roles']) ? Role::where(['name' => $userData['roles']])->get() : Role::where(['name' => 'student'])->first();
        abort_if(!$roles, 401, trans('auth.roles.not-found'));
        $userData['password'] = bcrypt($userData['password']);
        $user = User::create($userData);
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
        if (!empty($userData['roles'])) {
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
        $roles = !empty($userData['roles']) ?
            Role::where(['name' => $userData['roles']])->get() :
            Role::where(['name' => 'student'])->first();
        abort_if(!$roles, 401, trans('auth.roles.not-found'));
        $user = User::create($userData);
        (new UserInfoService($user))->create($userData);
        return $user;
    }
}
