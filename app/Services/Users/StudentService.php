<?php

namespace App\Services\Users;

use App\Models\Users\Student;
use App\Models\Users\User;

/**
 *
 */
class StudentService
{
    /**
     * @param User $user
     * @param array $fields
     * @param array $relations
     * @return Student|null
     */
    public static function getByUser(User $user, array $fields = [], array $relations = []): ?Student
    {
        $student = Student::query()
            ->hasAdminRole()
            ->where(['user_id' => $user->id])
            ->select(!empty($fields) ? $fields : ['*']);
        if(!empty($relations)) {
            $student->with($relations);
        }
        return $student->first();
    }

    /**
     * @param User $user
     * @param array $studentData
     * @return Student|null
     */
    public static function update(array $studentData, User $user): ?Student
    {
        $student = self::getByUser($user);
        $student->update($studentData);
        return $student;
    }

    /**
     * @param array $studentData
     * @param User $user
     * @return Student
     */
    public static function create(array $studentData, User $user): Student
    {
        /*
         * @ToDo Criar observer/notificação
         */
        if(self::hasUser($user)) {
            return self::update($user, $studentData);
        }
        $studentData['user_id'] = $user->id;
        return Student::create($studentData);
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function hasUser(User $user): bool
    {
        return Student::where(['user_id' => $user->id])->exists();
    }

    /**
     * @param int $points
     * @param User $user
     * @return int
     */
    public static function increasePoints(int $points, User $user): int
    {
        $student = self::getByUser($user);
        $student->points += $points;
        $student->save();
        return $student->points;
    }

    /**
     * @param int $points
     * @param User $user
     * @return int
     */
    public static function decreasePoints(int $points, User $user): int
    {
        $student = self::getByUser($user);
        $student->points -= max(0, $points);
        $student->save();
        return $student->points;
    }
}
