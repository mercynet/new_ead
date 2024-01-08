<?php

namespace App\Services\Users;

use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * The RoleService class provides methods to interact with Role objects.
 */
class RoleService
{
    private Role $model;

    public function __construct()
    {
        $this->model = new Role();
    }

    public function all(Request $request, int $pages = 20): Collection|LengthAwarePaginator|null
    {
        if ($pages === 0 || $request->get('all')) {
            return $this->builder($request)->get();
        }

        return $this->builder($request)->paginate($pages);
    }

    private function builder(Request $request): Builder
    {
        return $this->model
            ->query()
            ->where(['guard_name' => currentGuardName()])
            ->where(function ($query) {
                if (! auth()->user()->hasRole(\App\Enums\Users\Role::development->name)) {
                    $query->where('name', '!=', \App\Enums\Users\Role::development->name);
                }
            })
            ->with('permissions');
    }

    /**
     * Retrieves a Role by its name.
     *
     * @param  string  $name The name of the Role to retrieve.
     * @return Role|null The Role object with the given name, or null if not found.
     */
    public function roleByName(string $name): ?Role
    {
        return $this->model->where('name', $name)->first();
    }
}
