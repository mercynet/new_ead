<?php

namespace App\Services\Users;

use App\Exceptions\InvalidUploadException;
use App\Models\Role;
use App\Models\Users\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
    public function all(array $fields = [], array $relations = [], array $where = []): null|Collection
    {
        return $this->builder(fields: $fields, where: $where)->get();
    }

    /**
     * @param int|array $id
     * @return User
     */
    public function find(int|array $id): User
    {
        return $this->builder(where: ['id' => $id])->first();
    }

    /**
     * @param User $user
     * @param array $userData
     * @return User
     */
    public function update(User $user, array $userData): User
    {
        $user->update($userData);
        if (!empty($userData['roles'])) {
            $roles = Role::where(['name' => $userData['roles']])->get();
            $user->assignRole($roles);
        }
        if (!empty($userData['group_id'])) $user->group()->associate($userData['group_id']);
        (new UserInfoService($user))->update($userData);
        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function enable(User $user): User
    {
        $user->update(['active' => true]);
        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function disable(User $user): User
    {
        $user->update(['active' => false]);
        return $user;
    }

    /**
     * @param array $userData
     * @return User
     */
    public function register(array $userData): User
    {
        $roles = !empty($userData['roles']) ? Role::where(['name' => $userData['roles']])->get() : Role::where(['name' => 'student'])->first();
        abort_if(!$roles, 401, trans('auth.roles.not-found'));
        $userData['password'] = bcrypt($userData['password']);
        $user = User::create($userData);
        $user->assignRole($roles);
        return $this->builder(where: ['id' => $user->id])->first();
    }

    /**
     * @param array $data
     * @return User
     * @throws InvalidUploadException
     */
    public function create(array $data): User
    {
        $roles = !empty($data['role']) ? Role::where(['id' => $data['role']])->get() : Role::where(['name' => 'student'])->first();
        abort_if(!$roles, 401, trans('auth.roles.not-found'));
        if (!empty($data['avatar']) && preg_match('/^data:image\/(\w+);base64,/', $data['avatar'])) {
            $data['avatar'] = "users/" . prepareUpload($data['avatar'], 'users');
        }
        if ($data['group_id'] == 0) {
            unset($data['group_id']);
        }
        $user = User::create($data);
        $user->assignRole($roles);

        if (!empty($data['group_id'])) {
            $user->group()->associate($data['group_id']);
        }
        (new UserInfoService($user))->create($data);
        return $user;
    }

    /**
     * @param int $pages
     * @param array $fields
     * @param array $relations
     * @param array $where
     * @return LengthAwarePaginator
     */
    public function toPaginate(int $pages = 20, array $fields = [], array $relations = [], array $where = []): LengthAwarePaginator
    {
        return $this->builder($fields, $relations, $where)->paginate($pages);
    }

    /**
     * @param array $fields
     * @param array $relations
     * @param array $where
     * @return Builder
     */
    private function builder(array $fields = [], array $relations = [], array $where = []): Builder
    {
        $request = request();
        $users = User::query()
            ->hasAdminRole()
            ->select(!empty($fields) ? $fields : ['*'])
            ->with([
                'roles.permissions:id,name',
                'user_info',
                'instructor',
                'student',
                'group',
                'phone_numbers',
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
