<?php

namespace App\Policies;

use App\Models\Users\Student;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user): Response|bool
    {
        return $user->can('list students');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Student $student
     * @return Response|bool
     */
    public function view(User $user, Student $student): Response|bool
    {
        return $user->can('view students') && ($student->user_id === auth()->id() || auth()->user()->isAdmin());
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create students');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Student $student
     * @return bool
     */
    public function update(User $user, Student $student): bool
    {
        return $user->can('update students') && ($student->user_id === auth()->id() || auth()->user()->isAdmin());
    }
}
