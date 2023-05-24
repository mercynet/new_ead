<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasLog;
use App\Traits\HasRole;
use App\Traits\QueryModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 *
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasLog, HasRoles, SoftDeletes, QueryModel, HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group_id',
        'name',
        'email',
        'password',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
    ];

    /**
     * @return HasOne
     */
    public function instructor(): HasOne
    {
        return $this->hasOne(Instructor::class);
    }

    /**
     * @return HasOne
     */
    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * @return HasOne
     */
    public function userInfo(): HasOne
    {
        return $this->hasOne(UserInfo::class);
    }

    /**
     * @param Builder $query
     * @param array|string $roles
     * @return Collection
     */
    public function scopeByRoles(Builder $query, array|string $roles): Collection
    {
        return $query->whereHas("roles", function($q) use($roles) {
            if(is_array($roles)) {
                return $q->whereIn("name", $roles);
            }
            return $q->where(["name", $roles]);
        })->get();
    }
}
