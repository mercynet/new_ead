<?php

namespace App\Http\Controllers\Mzrt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\StoreInstructorRequest;
use App\Http\Requests\Mzrt\UpdateInstructorRequest;
use App\Http\Resources\Mzrt\InstructorResource;
use App\Models\Instructor;
use App\Services\Users\InstructorService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 *
 */
class InstructorController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Instructor::class, 'user');
    }
    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $this->authorize('viewAny', Instructor::class);

        return InstructorResource::collection(InstructorService::getAll(relations: [
            'roles.permissions:id,name',
            'userInfo' => ['timezone'],
        ]))->additional(['success' => true]);
    }

    /**
     * @param StoreInstructorRequest $request
     * @return void
     */
    public function store(StoreInstructorRequest $request)
    {
        $this->authorize('create', Instructor::class);
        $user = InstructorService::create($request->validated());
        return InstructorResource::make(InstructorService::getById(id: $user->id, relations: [
            'roles.permissions:id,name',
            'userInfo' => ['timezone'],
        ]));
    }

    /**
     * @param Instructor $user
     * @return InstructorResource|null
     */
    public function show(Instructor $user): ?InstructorResource
    {
        $this->authorize('view', $user);
        return InstructorResource::make($user->loadMissing(['roles.permissions']));
    }

    /**
     * @param UpdateInstructorRequest $request
     * @param Instructor $user
     * @return void
     */
    public function update(UpdateInstructorRequest $request, Instructor $user)
    {
        $this->authorize('update', $user);
        return InstructorResource::make(InstructorService::update($user, $request->validated()));
    }

    /**
     * @param Instructor $user
     * @return void
     */
    public function enable(Instructor $user)
    {
        $this->authorize('update', $user);
        return InstructorResource::make(InstructorService::update($user, ['active' => true]));
    }

    /**
     * @param Instructor $user
     * @return void
     */
    public function disable(Instructor $user)
    {
        $this->authorize('update', $user);
        return InstructorResource::make(InstructorService::update($user, ['active' => false]));
    }

    /**
     * @param Instructor $user
     * @return AnonymousResourceCollection
     */
    public function destroy(Instructor $user)
    {
        $this->authorize('delete', $user);
        $user->roles()->detach();
        $user->delete();
        return InstructorResource::collection(Instructor::paginate(20))->additional(['success' => true]);
    }
}
