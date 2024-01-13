<?php

namespace App\Traits;

use App\Enums\Users\Role;

trait HasRole
{
    /**
     * @param $query
     * @return void
     */
    public function scopeHasAdminRole($query): void
    {
        if (auth(currentGuardName())->check() && !auth(currentGuardName())->user()->hasRole([Role::development->name, Role::superuser->name])) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', '!=', 'development');
            });
        }
    }
    public function scopeIsAdmin($query): bool
    {
        return !auth(currentGuardName())->user()->hasRole([Role::development->name, Role::superuser->name]);
    }
}
