<?php

namespace App\Policies;

use App\Models\Users\Instructor;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class InstructorPolicy
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
        return $user->can('list instructors');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Instructor $instructors
     * @return Response|bool
     */
    public function view(User $user, Instructor $instructors): Response|bool
    {
        return $user->can('view instructors') && ($instructors->user_id === auth()->id() || auth()->user()->isAdmin());
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create instructors');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Instructor $instructors
     * @return bool
     */
    public function update(User $user, Instructor $instructors): bool
    {
        dd($user->can('update instructors'));
        return $user->can('update instructors') && ($instructors->user_id === auth()->id() || auth()->user()->isAdmin());
    }
}
