<?php

namespace App\Services\Users;

use App\Enums\Users\RoleGroup;
use App\Models\Role;
use App\Models\Users\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

/**
 * The RoleService class provides methods to interact with Role objects.
 */
class RoleService
{
    /**
     * @var Role
     */
    private Role $model;
    private Permission $permissionModel;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new Role();
        $this->permissionModel = new Permission();
    }

    /**
     * @param Request $request
     * @param int $pages
     * @return Collection|LengthAwarePaginator|null
     */
    public function all(Request $request, int $pages = 20): Collection|LengthAwarePaginator|null
    {
        if ($pages === 0 || ($request->get('all') === true)) {
            return $this->builder($request)->get();
        }

        return $this->builder($request)->paginate($pages);
    }

    public function show(Request $request, Role $role): Role|null
    {
        return $this->builder($request)->find($role->id);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function groups(Request $request): array
    {
        return RoleGroup::labels();
    }

    /**
     * @param Request $request
     * @return Builder
     */
    private function builder(Request $request): Builder
    {
        $builder = $this->model
            ->query()
            ->usersCount()
            ->where(function ($query) {
                if (!auth()->user()->hasRole(\App\Enums\Users\Role::development->name)) {
                    $query->where('name', '!=', \App\Enums\Users\Role::development->name);
                }
            });
        if ($request->guard && in_array($request->guard, guardNames())) {
            $builder->where(['guard_name' => $request->guard]);
        }
        return $builder->with(['permissions', 'users']);
    }

    /**
     * Retrieves a Role by its name.
     *
     * @param string $name The name of the Role to retrieve.
     * @return Role|null The Role object with the given name, or null if not found.
     */
    public function roleByName(string $name): ?Role
    {
        return $this->model->where('name', $name)->first();
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
        $roleData = [];
        foreach ($data['guard_name'] as $guardName) {
            $roleData[] = [
                'name' => $data['name'],
                'guard_name' => $guardName,
                'group_name' => $data['group_name'],
                'description' => $data['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        $this->model->insert($roleData);
    }

    /**
     * @param array $data
     * @return Role
     */
    public function createSimple(array $data): Role
    {
        return $this->model->create([
            'name' => $data['name'],
            'guard_name' => $data['guard_name'],
            'group_name' => $data['group_name'],
            'description' => $data['description'],
        ]);
    }

    /**
     * @param array $data
     * @param Role $role
     * @return Role
     */
    public function update(array $data, Role $role): Role
    {
        $roleData = [
            'name' => $data['name'],
            'guard_name' => $data['guard_name'],
            'group_name' => $data['group_name'],
            'description' => $data['description'],
        ];
        $role->update($roleData);
        $role->syncPermissions($data['permissions']);
        return $role;
    }

    /**
     * @param Request $request
     * @return Collection|null
     */
    public function permissions(Request $request): ?Collection
    {
        return $this->permissionModel
            ->where(['guard_name' => $request->guard ?? 'web'])
            ->where(function ($query) {
                if (!auth()->user()->hasRole(\App\Enums\Users\Role::development->name)) {
                    $query->where('Development', '!=', \App\Enums\Users\RoleGroup::development->label());
                }
            })
            ->get();
    }

    /**
     * @param Role $role
     * @return void
     */
    public function delete(Role $role): void
    {
        $role->delete();
    }
}
