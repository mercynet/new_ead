<?php

namespace App\Http\Controllers\API\V1\Mzrt\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mzrt\Users\RoleResource;
use App\Models\Role;
use App\Services\Users\RoleService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group MZRT
 *
 * @subgroup Users
 * Resources for users roles
 *
 * This class is responsible for handling user-related requests and actions.
 */
class RoleController extends Controller
{
    public function __construct(private readonly RoleService $roleService)
    {
        $this->authorizeResource(Role::class);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return RoleResource::collection($this->roleService->all($request));
    }

    public function store(Request $request)
    {
    }

    public function show(Role $role)
    {
    }

    public function update(Request $request, Role $role)
    {
    }

    public function destroy(Role $role)
    {
    }
}
