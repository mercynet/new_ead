<?php

namespace App\Services\Users;

use App\Models\Role;
use App\Models\Instructor;
use App\Models\User;
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
     * @param User $user
     * @param array $instructorData
     * @return Instructor|null
     */
    public static function update(User $user, array $instructorData): ?Instructor
    {
        $instructor = self::getByUserId($user->id);
        $instructor->update($instructorData);
        return $instructor;
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
