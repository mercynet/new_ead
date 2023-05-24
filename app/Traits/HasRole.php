<?php

namespace App\Traits;

trait HasRole
{
    /**
     * @param $query
     * @return void
     */
    public function scopeHasRole($query): void
    {
        if (!auth(getGuardName())->user()->hasRole('development')) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', '!=', 'development');
            });
        }
    }

}
