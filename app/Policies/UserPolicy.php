<?php

namespace App\Policies;

use App\Enums\Users\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('list administrators');
    }

    public function view(User $user, User $model): bool
    {
        if(!$user->hasRole([Role::development->name, Role::superuser->name])) {
            return $user->can('view administrators') && $user->id === $model->id;
        }
        return $user->can('view administrators');
    }

    public function create(User $user): bool
    {
        return $user->can('create administrators');
    }

    public function update(User $user, User $model): bool
    {
        if(!$user->hasRole([Role::development->name, Role::superuser->name])) {
            return $user->can('update administrators') && $user->id === $model->id;
        }
        return $user->can('update administrators');
    }

    public function delete(User $user, User $model): bool
    {
        return $user->can('delete administrators');
    }
}
