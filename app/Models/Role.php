<?php

namespace App\Models;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $hidden = ['pivot'];

    public function scopeUsersCount(Builder $query): Builder
    {
        /*
         * select coalesce(count(mhr.model_id), 0)
        from model_has_roles mhr
        where `mhr`.`role_id` = `roles`.`id` and `model_type` = 'App\\Models\\Users\\User'
        group by mhr.role_id) as users_count
         */
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
