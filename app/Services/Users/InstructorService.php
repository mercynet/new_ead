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
     * @param User $user
     * @param array $fields
     * @param array $relations
     * @return Instructor|null
     */
    public static function getByUser(User $user, array $fields = [], array $relations = []): ?Instructor
    {
        $instructor = Instructor::query()
            ->hasAdminRole()
            ->where(['user_id' => $user->id])
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
        $instructor = self::getByUser($user);
        $instructor->update($instructorData);
        return $instructor;
    }

    /**
     * @param array $instructorData
     * @param User $user
     * @return Instructor
     */
    public static function create(array $instructorData, User $user): Instructor
    {
        /*
         * @ToDo Criar notificação
         */
        if(self::hasUser($user)) {
            return self::update($user, $instructorData);
        }
        $instructorData['user_id'] = $user->id;
        return Instructor::create($instructorData);
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function hasUser(User $user): bool
    {
        return Instructor::where(['user_id' => $user->id])->exists();
    }
}
