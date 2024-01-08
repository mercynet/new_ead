<?php

namespace App\Http\Controllers\API\V1\Mzrt\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mzrt\Users\GroupUserResource;
use App\Models\Users\GroupUser;
use App\Services\Users\GroupUserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group MZRT
 *
 * Class GroupUserController
 *
 * @subgroup Users
 *
 * This class is responsible for handling the requests related to the GroupUser resource.
 */
class GroupUserController extends Controller
{
    public function __construct(private readonly GroupUserService $groupUserService)
    {
        $this->authorizeResource(GroupUser::class);
    }

    /**
     * Retrieves a collection of group users based on the provided request.
     *
     * @param  Request  $request The HTTP request object.
     * @return AnonymousResourceCollection A collection of GroupUserResource objects.
     */
    public function index(Request $request)
    {
        return GroupUserResource::collection($this->groupUserService->groups(request: $request));
    }

    /**
     * Retrieve all group users.
     *
     * @param  Request  $request The HTTP request object.
     * @return AnonymousResourceCollection The collection of group users.
     */
    public function all(Request $request): AnonymousResourceCollection
    {
        return GroupUserResource::collection($this->groupUserService->groups(request: $request, paginate: 0));
    }

    public function store(Request $request)
    {
    }

    public function show(GroupUser $groupUser)
    {
    }

    public function update(Request $request, GroupUser $groupUser)
    {
    }

    public function destroy(GroupUser $groupUser)
    {
    }
}
