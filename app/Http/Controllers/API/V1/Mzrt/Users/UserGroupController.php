<?php

namespace App\Http\Controllers\API\V1\Mzrt\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\Users\Groups\StoreUserGroupRequest;
use App\Http\Requests\Mzrt\Users\Groups\UpdateUserGroupRequest;
use App\Http\Resources\Mzrt\Users\UserGroupResource;
use App\Models\Users\Group;
use App\Services\Users\UserGroupService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Mozart
 *
 * @subgroup User Groups
 * @subgroupDescription List of groups of users
 */
class UserGroupController extends Controller
{
    private array $additionalReturn = ['success' => true];

    public function __construct(private readonly UserGroupService $userGroupService)
    {
        $this->authorizeResource(Group::class, 'group');
    }

    /**
     * Displays a list of all groups of users. It accepts one parameter "all". Case has this parameter,
     * it returns all groups of users with no paginate.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return UserGroupResource::collection($request->all ? $this->userGroupService->all() : $this->userGroupService->paginate());
    }

    /**
     * Store a new user group
     *
     * @param StoreUserGroupRequest $request
     * @return UserGroupResource
     */
    public function store(StoreUserGroupRequest $request)
    {
        return UserGroupResource::make($this->userGroupService->create($request->validated()));
    }

    /**
     * @param Group $group
     * @return void
     */
    public function show(Group $group)
    {
        return UserGroupResource::make($this->userGroupService->group($group->id));
    }

    /**
     * Update a specific user group
     *
     * @param UpdateUserGroupRequest $request
     * @param Group $user_group
     * @return void
     */
    public function update(UpdateUserGroupRequest $request, Group $user_group)
    {
        $this->userGroupService->update($request->validated(), $user_group);
        return UserGroupResource::make($this->userGroupService->group($user_group->id));
    }
}
