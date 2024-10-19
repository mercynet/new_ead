<?php

namespace App\Traits;

use App\Enums\Users\Role;
use App\Models\Users\User;
use Illuminate\Contracts\Auth\Authenticatable;

trait HasRole
{
    /**
     * @var Authenticatable|User|null
     */
    private readonly User|Authenticatable|null $user;
    public function __construct()
    {
        //
    }

    /**
     * @param $query
     * @return void
     */
    public function scopeHasAdminRole($query): void
    {
        if (auth()->check() && $this->hasRole([Role::development->name, Role::superuser->name])) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', '!=', 'development');
            });
        }
    }
    public function scopeIsAdmin($query): bool
    {
        return $this->hasRole([Role::development->name, Role::superuser->name]) || in_array($this->type->name, [Role::development->name, Role::superuser->name]);
    }
    public function scopeIsStudent($query): bool
    {
        return $this->hasRole([Role::student->name]) || $this->type->name == Role::student->name;
    }
    public function scopeIsInstructor($query): bool
    {
        return $this->hasRole([Role::instructor->name]) || $this->type->name == Role::instructor->name;
    }
}
