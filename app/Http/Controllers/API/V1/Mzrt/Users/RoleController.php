<?php

namespace App\Http\Controllers\API\V1\Mzrt\Users;

use App\Enums\Users\RoleGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\Users\RoleRequest;
use App\Http\Resources\Mzrt\Users\RoleResource;
use App\Models\Role;
use App\Services\Users\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Mozart
 *
 * @subgroup Users
 * Resources for users roles
 *
 * This class is responsible for handling user-related requests and actions.
 */
class RoleController extends Controller
{
    /**
     * @param RoleService $roleService
     */
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

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function groups(Request $request)
    {
        $groups = $this->roleService->groups($request);
        if (!auth()->user()->hasRole(\App\Enums\Users\Role::development->name)) {
            unset($groups[RoleGroup::development->name]);
        }
        return response()->json($groups);
    }
    public function permissions(Request $request)
    {
        return response()->json($this->roleService->permissions($request));
    }

    /**
     * Method to store a new role in the storage
     * @param RoleRequest $request
     * @return void
     */
    public function store(RoleRequest $request)
    {
        $this->roleService->create($request->validated());
        $request->merge(['all' => false, 'guard_name' => 'web']);
        return response()->created(RoleResource::collection($this->roleService->all($request)));
    }

    /**
     * Method to store a new role in the storage but not from bulk
     * @param RoleRequest $request
     * @return mixed
     */
    public function storeSimple(RoleRequest $request)
    {
        $role = $this->roleService->createSimple($request->validated());
        $request->merge(['all' => false, 'guard_name' => 'web']);
        return response()->created(RoleResource::make($this->roleService->show($request, $role)));
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return void
     */
    public function show(Request $request, Role $role)
    {
        return RoleResource::make($this->roleService->show($request, $role));
    }

    /**
     * @param RoleRequest $request
     * @param Role $role
     * @return void
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->roleService->update($request->validated(), $role);
        $request->merge(['all' => false, 'guard_name' => 'web']);
        return response()->ok(RoleResource::make($this->roleService->show($request, $role)));
    }

    /**
     * @param Role $role
     * @return void
     */
    public function destroy(Role $role)
    {
    }
}
