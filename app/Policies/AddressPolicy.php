<?php

namespace App\Policies;

use App\Enums\Users\Role;
use App\Models\Users\Address;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 *
 */
class AddressPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('list addresses');
    }

    /**
     * @param User $user
     * @param Address $address
     * @return bool
     */
    public function view(User $user, Address $address): bool
    {
        if(!$user->hasRole([Role::development->name, Role::superuser->name])) {
            return $user->can('view addresses') && $user->id === $address->user_id;
        }
        return $user->can('view addresses');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create addresses');
    }

    /**
     * @param User $user
     * @param Address $address
     * @return bool
     */
    public function update(User $user, Address $address): bool
    {
        if(!$user->hasRole([Role::development->name, Role::superuser->name])) {
            return $user->can('update addresses') && $user->id === $address->user_id;
        }
        return $user->can('update addresses');
    }

    /**
     * @param User $user
     * @param Address $address
     * @return bool
     */
    public function delete(User $user, Address $address): bool
    {
        return $user->can('delete addresses');
    }
}
