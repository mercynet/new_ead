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
        if (!auth(getGuardName())->user()->hasRole([Role::development->name, Role::superuser->name])) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', '!=', 'development');
            });
        }
    }

}
