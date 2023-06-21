<?php

namespace App\Services\Users;

use App\Models\Role;
use App\Models\Instructor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 */
class InstructorService
{
    /**
     * @param int $userId
     * @param array $fields
     * @param array $relations
     * @return Instructor|null
     */
    public static function getByUserId(int $userId, array $fields = [], array $relations = []): ?Instructor
    {
        $instructor = Instructor::query()
            ->hasAdminRole()
            ->where(['user_id' => $userId])
            ->select(!empty($fields) ? $fields : ['*']);
        if(!empty($relations)) {
            $instructor->with($relations);
        }
        return $instructor->first();
    }
    /**
     * @param array $instructorData
     * @return Instructor|null
     */
    public static function register(array $instructorData): ?Instructor
    {
        $instructorData['password'] = bcrypt($instructorData['password']);
        $instructor = Instructor::create($instructorData);
        $roles = !empty($instructorData['roles']) ? Role::where(['name' => $instructorData['roles']])->get() : Role::where(['name' => 'student'])->first();
        abort_if(!$roles, 401, trans('auth.roles.not-found'));
        $instructor->assignRole($roles);
        return $instructor->loadMissing(['roles.permissions']);
    }

    /**
     * @param Instructor $instructor
     * @param array $instructorData
     * @return Instructor|null
     */
    public static function update(Instructor $instructor, array $instructorData): ?Instructor
    {
        $instructor->update($instructorData);

        if(!empty($instructorData['roles'])) {
            $roles = Role::where(['name' => $instructorData['roles']])->get();
            $instructor->assignRole($roles);
        }

        return $instructor->loadMissing(['roles.permissions']);
    }

    /**
     * @param array $instructorData
     * @return Instructor
     */
    public static function create(array $instructorData): Instructor
    {
        /*
         * @ToDo Criar notificação
         */
        return Instructor::create($instructorData);
    }
}
