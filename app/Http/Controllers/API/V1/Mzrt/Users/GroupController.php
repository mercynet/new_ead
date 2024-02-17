<?php

namespace App\Http\Controllers\API\V1\Mzrt\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\Users\Groups\StoreUserGroupRequest;
use App\Http\Requests\Mzrt\Users\Groups\UpdateUserGroupRequest;
use App\Http\Resources\Mzrt\Users\GroupResource;
use App\Models\Users\Group;
use App\Services\Users\GroupService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Mozart
 *
 * Class GroupController
 *
 * @subgroup Users
 *
 * This class is responsible for handling the requests related to the Group resource.
 */
class GroupController extends Controller
{
    public function __construct(private readonly GroupService $groupUserService)
    {
        $this->authorizeResource(Group::class);
    }

    /**
     * Retrieves a collection of group users based on the provided request.
     *
     * @param  Request  $request The HTTP request object.
     * @return AnonymousResourceCollection A collection of GroupResource objects.
     */
    public function index(Request $request)
    {
        return GroupResource::collection($this->groupUserService->groups(request: $request));
    }

    /**
     * Retrieve all group users.
     *
     * @param  Request  $request The HTTP request object.
     * @return AnonymousResourceCollection The collection of group users.
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        return GroupResource::collection($this->groupUserService->groups(request: $request, paginate: 0));
    }

    /**
     * Store a new resource
     * @param StoreUserGroupRequest $request
     * @return mixed
     */
    public function store(StoreUserGroupRequest $request)
    {
        $group = $this->groupUserService->create($request->validated());
        return response()->created(GroupResource::make($group));
    }

    /**
     * Get a specific resource
     * @param Group $group
     * @return Group
     */
    public function show(Group $group)
    {
        return GroupResource::make($this->groupUserService->show($group));
    }

    public function update(UpdateUserGroupRequest $request, Group $group)
    {
        $this->groupUserService->update($request->validated(), $group);
        return GroupResource::make($group);
    }

    public function destroy(Group $groupUser)
    {
    }
}
