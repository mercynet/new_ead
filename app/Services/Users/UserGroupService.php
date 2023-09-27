<?php

namespace App\Services\Users;

use App\Models\Users\Group;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 *
 */
class UserGroupService
{
    /**
     * @return Collection|null
     */
    public function all(): ?Collection
    {
        return self::groupData()->get();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return self::groupData()->paginate($perPage);
    }

    /**
     * @param array|null $where
     * @return Builder
     */
    private function groupData(?array $where = []): Builder
    {
        $build = Group::select(['id', 'name', 'discount', 'commission'])->with(['users.roles']);
        if(!empty($where)) {
            $build->where($where);
        }
        return $build;
    }

    /**
     * @param array $validated
     * @return Group|null
     */
    public function create(array $validated): ?Group
    {
        return Group::create($validated);
    }

    /**
     * @param int $id
     * @return Group|null
     */
    public function group(int $id): ?Group
    {
        return Group::with(['users.roles'])->find($id);
    }

    /**
     * @param array $data
     * @param Group $group
     * @return void
     */
    public function update(array $data, Group $group): void
    {
        $group->update($data);
    }
}
