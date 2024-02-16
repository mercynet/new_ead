<?php

namespace App\Services\Users;

use App\Models\Users\Group;
use App\Services\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as SupportCollection;

/**
 * Class GroupService
 *
 * The GroupService class extends the Service class and provides methods for working with Group models.
 */
class GroupService extends Service
{
    protected readonly Model $model;

    /**
     * @var array|string[]
     */
    protected array $with = [
        'users',
    ];

    public function __construct()
    {
        $this->model = new Group();
    }

    /**
     * Build a group of records based on given parameters.
     *
     * @param Request|null $request The optional request object.
     * @param array|null $fields The optional array of fields to select.
     * @param array|null $relations The optional array of relations to eager load.
     * @param array $where The array of conditions to apply to the query.
     * @return Builder The Laravel query builder instance.
     */
    public function groupBuilder(?Request $request = null, ?array $fields = null, ?array $relations = null, array $where = []): Builder
    {
        $this->with = $this->addToRelationsIfNeeded($this->with, $relations);

        return $this->builder($fields, $where);
    }

    /**
     * Retrieve groups.
     *
     * @param Request|null $request Request object (optional)
     * @param array|null $fields Fields to include (optional)
     * @param array|null $relations Relations to include (optional)
     * @param array $where Where conditions (optional)
     * @param int $paginate Number of items per page (optional, default is 20)
     * @return LengthAwarePaginator|SupportCollection|null
     */
    public function groups(?Request $request = null, ?array $fields = null, ?array $relations = null, array $where = [], int $paginate = 20): LengthAwarePaginator|Collection|null
    {
        $fields = $fields ?: ['id', 'name', 'discount', 'commission', 'created_at', 'updated_at'];
        $builder = $this->groupBuilder($request, $fields, $relations, $where)->withCount('users');
        if ($paginate > 0) {
            return $builder->paginate($paginate);
        }
        return $builder->get();
    }

    /**
     * Retrieve a Group with its related users and count of users
     *
     * @param Group $groupUser The Group object to fetch
     * @return Group|null The retrieved Group object with related users and count of users, or null if not found
     */
    public function group(Group $groupUser): ?Group
    {
        return $this->model->with(['users'])->withCount('users')->find($groupUser->id);
    }

    /**
     * @param mixed $validated
     * @return Group
     */
    public function create(mixed $validated): Group
    {
        return $this->model->create($validated);
    }
}
