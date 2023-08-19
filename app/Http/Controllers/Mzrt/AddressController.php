<?php

namespace App\Http\Controllers\Mzrt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\AddressRequest;
use App\Http\Resources\Mzrt\AddressResource;
use App\Models\Address;
use App\Models\User;
use App\Services\Users\AddressService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 */
class AddressController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Address::class, 'address');
    }

    /**
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function getByUser(Request $request, User $user)
    {
        return AddressResource::collection((new AddressService())->getByUser($request, $user))->additional(['success' => true]);
    }

    /**
     * @param AddressRequest $request
     * @param User $user
     * @return AddressResource
     */
    public function store(AddressRequest $request, User $user)
    {
        return AddressResource::make((new AddressService())->create($request->validated(), $user));
    }

    /**
     * @param Address $address
     * @param User $user
     * @return void
     */
    public function show(Address $address, User $user)
    {
    }

    /**
     * @param AddressRequest $request
     * @param User $user
     * @param Address $address
     * @return AddressResource
     */
    public function update(AddressRequest $request, User $user, Address $address): AddressResource
    {
        abort_if($address->user_id !== $user->id, Response::HTTP_FORBIDDEN);
        return AddressResource::make((new AddressService())->update($request->validated(), $address, $user));
    }

    /**
     * @param Address $address
     * @return void
     */
    public function destroy(Address $address)
    {
    }
}
