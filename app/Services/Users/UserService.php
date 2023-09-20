<?php

namespace App\Services\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use LaravelIdea\Helper\App\Models\_IH_User_QB;

/**
 *
 */
class UserService
{
    /**
     * @param array $fields
     * @param array $relations
     * @param array $where
     * @return Collection|null
     */
    public static function getAll(array $fields = [], array $relations = [], array $where = []): null|Collection
    {
        return self::getUsers(fields: $fields, where: $where)->get();
    }

    /**
     * @param int|array $id
     * @return User
     */
    public static function getById(int|array $id): User
    {
        return self::getUsers(where: ['id' => $id])->first();
    }

    /**
     * @param User $user
     * @param array $userData
     * @return User
     */
    public static function update(User $user, array $userData): User
    {
        $user->update($userData);
        if (!empty($userData['roles'])) {
            $roles = Role::where(['name' => $userData['roles']])->get();
            $user->assignRole($roles);
        }
        if(!empty($userData['group_id'])) $user->group()->associate($userData['group_id']);
        (new UserInfoService($user))->update($userData);
        return $user;
    }

    /**
     * @param array $userData
     * @return Model
     */
    public static function register(array $userData): Model
    {
        $roles = !empty($userData['roles']) ? Role::where(['name' => $userData['roles']])->get() : Role::where(['name' => 'student'])->first();
        abort_if(!$roles, 401, trans('auth.roles.not-found'));
        $userData['password'] = bcrypt($userData['password']);
        $user = User::create($userData);
        $user->assignRole($roles);
        return self::getUsers(where: ['id' => $user->id])->first();
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
        $userData['document'] = justNumbers($userData['document']);
        $user = User::create($userData);
        $user->assignRole($roles);
        $user->group()->associate($userData['group_id']);
        (new UserInfoService($user))->create($userData);
        return $user;
    }

    /**
     * @param int $pages
     * @param array $fields
     * @param array $relations
     * @param array $where
     * @return LengthAwarePaginator
     */
    public static function toPaginate(int $pages = 20, array $fields = [], array $relations = [], array $where = []): LengthAwarePaginator
    {
        return self::getUsers($fields, $relations, $where)->paginate($pages);
    }

    /**
     * @param array $fields
     * @param array $relations
     * @param array $where
     * @return Builder
     */
    private static function getUsers(array $fields = [], array $relations = [], array $where = []): Builder
    {
        $request = request();
        $users = User::query()
            ->hasAdminRole()
            ->select(!empty($fields) ? $fields : ['*'])
            ->with([
                'roles.permissions:id,name',
                'user_info' => ['timezone'],
                'instructor',
                'student',
                'group',
                'addresses.country',
            ]);
        if (!empty($where)) {
            $users->where($where);
        }
        if ($request->roles) {
            $users->whereHas("roles", function ($q) use ($request) {
                return !is_array($request->roles) ?
                    $q->where(["name" => $request->roles]) :
                    $q->whereIn("name", $request->roles);
            });
        }
        return $users;
    }
}
