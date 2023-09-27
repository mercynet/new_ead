<?php

namespace App\Http\Controllers\Mzrt\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\AddressRequest;
use App\Http\Resources\Mzrt\Users\AddressResource;
use App\Models\Users\Address;
use App\Models\Users\User;
use App\Services\Users\AddressService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Mozart
 *
 * @subgroup User Addresses
 * @subgroupDescription Methods from users addresses
 */
class AddressController extends Controller
{
    /**
     *
     */
    public function __construct(private readonly AddressService $addressService)
    {
        $this->authorizeResource(Address::class, 'address');
    }

    /**
     * Display a list of addresses, with their associated users
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return AddressResource::collection($this->addressService->all($request));
    }

    /**
     * Get all addresses from a given user
     *
     * @return AnonymousResourceCollection
     */
    public function getByUser(Request $request, User $user)
    {
        return AddressResource::collection($this->addressService->getByUser($request, $user))->additional(['success' => true]);
    }

    /**
     * Store a new address for the specified user
     *
     * @param AddressRequest $request
     * @param User $user
     * @return AddressResource
     */
    public function store(AddressRequest $request, User $user)
    {
        return AddressResource::make($this->addressService->create($request->validated(), $user));
    }

    /**
     * Get a specific address from the user
     *
     * @param Address $address
     * @return void
     */
    public function show(Address $address)
    {
        return AddressResource::make($this->addressService->getById($address->id));
    }

    /**
     * Updates an existing address
     *
     * @param AddressRequest $request
     * @param User $user
     * @param Address $address
     * @return AddressResource
     */
    public function update(AddressRequest $request, User $user, Address $address): AddressResource
    {
        abort_if($address->user_id !== $user->id, Response::HTTP_FORBIDDEN);
        return AddressResource::make($this->addressService->update($request->validated(), $address, $user));
    }

    /**
     * Deletes an address
     *
     * @param Address $address
     * @return \Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|\Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return response()->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
