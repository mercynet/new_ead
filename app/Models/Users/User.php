<?php

namespace App\Models\Users;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Courses\Course;
use App\Models\Courses\CourseUser;
use App\Traits\HasLog;
use App\Traits\HasRole;
use App\Traits\QueryModel;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 *
 * @method isAdmin()
 * @method static create(array $userData)
 * @property mixed $id
 * @property mixed $document
 * @property mixed|string|null $avatar
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

    public static function newFactory(): Factory
    {
        return UserFactory::new();
    }

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
    public function user_info(): HasOne
    {
        return $this->hasOne(UserInfo::class);
    }

    /**
     * @return HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /**
     * @return HasMany
     */
    public function phone_numbers(): HasMany
    {
        return $this->hasMany(PhoneNumber::class);
    }

    /**
     * @return BelongsToMany
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)->using(CourseUser::class);
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
