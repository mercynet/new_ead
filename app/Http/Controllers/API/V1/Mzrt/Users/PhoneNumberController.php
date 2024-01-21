<?php

namespace App\Http\Controllers\API\V1\Mzrt\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\Users\PhoneNumberRequest;
use App\Http\Resources\Mzrt\Users\PhoneNumberResource;
use App\Models\Users\PhoneNumber;
use App\Models\Users\User;
use App\Services\Users\PhoneNumberService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PhoneNumberController extends Controller
{
    public function __construct(private readonly PhoneNumberService $phoneNumberService)
    {
        $this->authorizeResource(PhoneNumber::class, 'phoneNumber');
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param User $user
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, User $user): AnonymousResourceCollection
    {
        return PhoneNumberResource::collection($this->phoneNumberService->all($request, $user));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PhoneNumberRequest $request
     * @param User $user
     * @return Response
     */
    public function store(PhoneNumberRequest $request, User $user)
    {
        $data = array_merge($request->validated(), ['user_id' => $user->id]);
        $phoneNumber = $this->phoneNumberService->create($data);
        return response()->created(PhoneNumberResource::make($phoneNumber));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PhoneNumberRequest $request
     * @param PhoneNumber $phoneNumber
     * @return Response
     */
    public function update(PhoneNumberRequest $request, PhoneNumber $phoneNumber)
    {
        $phoneNumber = $this->phoneNumberService->update($phoneNumber, $request->validated());
        return response()->ok(PhoneNumberResource::make($phoneNumber));
    }

    public function destroy(PhoneNumber $phoneNumber)
    {
        $this->phoneNumberService->delete($phoneNumber);
        return response()->noContent();
    }
}
