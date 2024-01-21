<?php

namespace App\Services\Users;

use App\Models\Users\PhoneNumber;
use App\Models\Users\User;
use App\Services\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PhoneNumberService extends Service
{
    protected readonly Model $model;
    protected array $with = [
        'user',
    ];

    public function __construct()
    {
        $this->model = new PhoneNumber();
    }

    /**
     * @param Request $request
     * @param User $user
     * @param int $pages
     * @return LengthAwarePaginator|Collection|null
     */
    public function all(Request $request, User $user, int $pages = 20): LengthAwarePaginator|Collection|null
    {
        $builder = $this->dataBuilder(request: $request, where: ['user_id' => $user->id])->orderByDesc('id');
        if($pages > 0) {
            return $builder->paginate($pages);
        }
        return $builder->get();
    }

    /**
     * @param int|array $id
     * @return PhoneNumber
     */
    public function find(int|array $id): PhoneNumber
    {
        return $this->builder(where: ['id' => $id])->first();
    }

    /**
     * @param User $user
     * @return PhoneNumber
     */
    public function findByUser(User $user): PhoneNumber
    {
        return $this->builder(where: ['user_id' => $user->id])->first();
    }

    /**
     * @param PhoneNumber $phoneNumber
     * @param array $data
     * @return PhoneNumber
     */
    public function update(PhoneNumber $phoneNumber, array $data): PhoneNumber
    {
        $data['phone_number'] = justNumbers($data['phone_number']);
        $phoneNumber->update($data);
        return $phoneNumber;
    }

    /**
     * @param array $data
     * @return PhoneNumber
     */
    public function create(array $data): PhoneNumber
    {
        $data['phone_number'] = justNumbers($data['phone_number']);
        return $this->model->create($data);
    }

    protected function dataBuilder(?Request $request = null, ?array $fields = null, ?array $relations = null, array $where = []): Builder
    {
        $this->with = $this->addToRelationsIfNeeded($this->with, $relations);
        return $this->builder($fields, $where);
    }

    /**
     * @param PhoneNumber $phoneNumber
     * @return void
     */
    public function delete(PhoneNumber $phoneNumber): void
    {
        $phoneNumber->delete();
    }
}
