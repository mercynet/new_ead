<?php

namespace App\Policies;

use App\Enums\Users\Role;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('list_users');
    }

    public function view(User $user, User $model): bool
    {
        if(!$user->hasRole([Role::development->name, Role::superuser->name])) {
            return $user->can('view_users') && $user->id === $model->id;
        }
        return $user->can('view_users');
    }

    public function create(User $user): bool
    {
        return $user->can('create_users');
    }

    public function update(User $user, User $model): bool
    {
        if(!$user->hasRole([Role::development->name, Role::superuser->name])) {
            return $user->can('update_users') && $user->id === $model->id;
        }
        return $user->can('update_users');
    }

    public function delete(User $user, User $model): bool
    {
        return $user->can('delete_users');
    }
}
