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
    /**
     *
     */
    public function __construct()
    {
        $this->authorizeResource(Instructor::class, 'instructor');
    }

    /**
     * @return void
     */
    public function index(): void
    {
        abort(404);
    }

    /**
     * @param StoreInstructorRequest $request
     * @return void
     */
    public function store(StoreInstructorRequest $request)
    {
        $data = $request->validated();
        InstructorService::create($data);
        return InstructorResource::make(InstructorService::getByUserId(userId: $data['user_id']));
    }

    /**
     * @param Instructor $instructor
     * @return InstructorResource|null
     */
    public function show(Instructor $instructor): ?InstructorResource
    {
        return InstructorResource::make($instructor->loadMissing(['roles.permissions']));
    }

    /**
     * @param UpdateInstructorRequest $request
     * @param Instructor $instructor
     * @return void
     */
    public function update(UpdateInstructorRequest $request, Instructor $instructor)
    {
        return InstructorResource::make(InstructorService::update($instructor, $request->validated()));
    }

    /**
     * @param Instructor $instructor
     * @return void
     */
    public function enable(Instructor $instructor)
    {
        return InstructorResource::make(InstructorService::update($instructor, ['active' => true]));
    }

    /**
     * @param Instructor $instructor
     * @return void
     */
    public function disable(Instructor $instructor)
    {
        return InstructorResource::make(InstructorService::update($instructor, ['active' => false]));
    }

    /**
     * @param Instructor $instructor
     * @return AnonymousResourceCollection
     */
    public function destroy(Instructor $instructor)
    {
        $instructor->roles()->detach();
        $instructor->delete();
        return InstructorResource::collection(Instructor::paginate(20))->additional(['success' => true]);
    }
}
