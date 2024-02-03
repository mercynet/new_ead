<?php

namespace App\Services\Users;

use App\Models\Users\Address;
use App\Models\Users\User;
use App\Services\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 *
 */
class AddressService extends Service
{
    protected readonly Model $model;
    protected array $with = [
        'user',
    ];

    public function __construct()
    {
        $this->model = new Address();
    }

    /**
     * @param int|array $id
     * @return Address|null
     */
    public function find(int|array $id): ?Address
    {
        return $this->builder(where: ['id' => $id])->first();
    }

    /**
     * @param User $user
     * @return Collection|null
     */
    public function findByUser(User $user): ?Collection
    {
        return $this->model->where(['user_id' => $user->id])->get();
    }

    /**
     * @param array $data
     * @param User $user
     * @return Address
     */
    public function create(array $data, User $user): Address
    {
        $data['user_id'] = $user->id;
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param Address $address
     * @return Address
     */
    public function update(array $data, Address $address): Address
    {
        $data['zip_code'] = justNumbers($data['zip_code']);
        $address->update($data);
        return $address;
    }

    /**
     * @param Request $request
     * @param User $user
     * @param int $pages
     * @return LengthAwarePaginator|EloquentCollection|null
     */
    public function all(Request $request, User $user, int $pages = 20): LengthAwarePaginator|Collection|null
    {
        $builder = $this->dataBuilder(request: $request, where: ['user_id' => $user->id])->orderByDesc('id');
        if($pages > 0) {
            return $builder->paginate($pages);
        }
        return $builder->get();
    }
    protected function dataBuilder(?Request $request = null, ?array $fields = null, ?array $relations = null, array $where = []): Builder
    {
        $this->with = $this->addToRelationsIfNeeded($this->with, $relations);
        return $this->builder($fields, $where);
    }

    /**
     * @param Address $address
     * @return void
     */
    public function delete(Address $address): void
    {
        $address->delete();
    }
}
