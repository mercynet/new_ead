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
        $this->user = auth(currentGuardName())->user();
    }

    /**
     * @param $query
     * @return void
     */
    public function scopeHasAdminRole($query): void
    {
        if (auth(currentGuardName())->check() && $this->user->hasRole([Role::development->name, Role::superuser->name])) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', '!=', 'development');
            });
        }
    }
    public function scopeIsAdmin($query): bool
    {
        return $this->user->hasRole([Role::development->name, Role::superuser->name]) || in_array($this->user->type->name, [Role::development->name, Role::superuser->name]);
    }
    public function scopeIsStudent($query): bool
    {
        return $this->user->hasRole([Role::student->name]) || $this->user->type->name == Role::student->name;
    }
    public function scopeIsInstructor($query): bool
    {
        return $this->user->hasRole([Role::instructor->name]) || $this->user->type->name == Role::instructor->name;
    }
}
