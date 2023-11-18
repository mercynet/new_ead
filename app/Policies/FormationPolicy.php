<?php

namespace App\Policies;

use App\Models\Courses\Formation;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Users\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Users\User  $user
     * @param  \App\Models\Courses\Formation  $formation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Formation $formation)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Users\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Users\User  $user
     * @param  \App\Models\Courses\Formation  $formation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Formation $formation)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Users\User  $user
     * @param  \App\Models\Courses\Formation  $formation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Formation $formation)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Users\User  $user
     * @param  \App\Models\Courses\Formation  $formation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Formation $formation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Users\User  $user
     * @param  \App\Models\Courses\Formation  $formation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Formation $formation)
    {
        //
    }
}
