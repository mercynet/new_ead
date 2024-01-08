<?php

namespace App\Http\Controllers\API\V1\Mzrt\Users;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
    }

    public function show(Group $groupUser)
    {
    }

    public function update(Request $request, Group $groupUser)
    {
    }

    public function destroy(Group $groupUser)
    {
    }
}
