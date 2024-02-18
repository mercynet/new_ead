<?php

namespace App\Policies;

use App\Models\Courses\Course;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CoursePolicy
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
        return $user->can('list_courses');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Course $course
     * @return Response|bool
     */
    public function view(User $user, Course $course): Response|bool
    {
        return $user->can('view_courses');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        return $user->can('create_courses');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Course $course
     * @return Response|bool
     */
    public function update(User $user, Course $course): Response|bool
    {
        return $user->can('update_courses');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Course $course
     * @return bool
     */
    public function delete(User $user, Course $course)
    {
        return $user->can('delete_courses');
    }
}
