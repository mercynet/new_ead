<?php

namespace App\Models;

use App\Models\Users\ModelHasRole;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\PermissionRegistrar;

/**
 *
 */
class Role extends SpatieRole
{
    /**
     * @var string[]
     */
    protected $hidden = ['pivot'];

    public function users(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(
            User::class,
            'model',
            'model_has_roles',
            'role_id',
            'model_id'
        );
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeUsersCount(Builder $query): Builder
    {
        return $query->select(['roles.*'])
            ->addSelect(['users_count' => fn($query) =>
                $query->selectRaw('COUNT(mhr.model_id)')
                ->from('model_has_roles as mhr')
                ->whereColumn('mhr.role_id', 'roles.id')
                ->where('mhr.model_type', User::class)
                ->groupBy('mhr.role_id')
                ->limit(1)
            ]);
    }
}
