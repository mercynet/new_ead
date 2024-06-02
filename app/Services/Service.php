<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Service
{
    /**
     * @var array
     */
    protected array $with = [];

    /**
     * @var Model
     */
    protected readonly Model $model;

    /**
     * @param array|null $fields
     * @param array $where
     * @return Builder
     */
    protected function builder(?array $fields = null, array $where = []): Builder
    {
        $fields = $fields ?? ['*'];
        $resource = $this->model->query()->select($fields);
        if ($this->with) {
            $resource->with($this->with);
        }
        $search = request()->get('search', '');
        if(!empty($search)) {
            $resource->search($search);
        }
        if ($where) {
            $resource->where($where);
        }

        return $resource;
    }

    /**
     * Adds new relations to the existing relations if needed.
     *
     * @param  array  $existingRelations The existing relations.
     * @param  array|null  $newRelations The new relations to add.
     * @return array The updated array of relations.
     */
    protected function addToRelationsIfNeeded(array $existingRelations, ?array $newRelations): array
    {
        if (! empty($newRelations)) {
            array_push($existingRelations, ...$newRelations);
        }

        return $existingRelations;
    }
}
