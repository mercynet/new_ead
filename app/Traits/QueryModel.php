<?php

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

trait QueryModel
{
    // Get Fillable Fields
    public function scopeResolve(Builder $query, $params = []): Collection|LengthAwarePaginator|array
    {
        //Receive query
        $query = QueryBuilder::for($query);
        $filters = $this->getFilterable();
        $query = $query->allowedFields($this->fields());

        if (isset($params['trashed'])) {
            $filters = array_merge($filters, (array)AllowedFilter::trashed());
        }

        $query = $query->allowedFilters($filters);

        if (isset($params['sort'])) {
            $sorts = array_merge($this->getSortable(), method_exists($this, 'externalSorts') ? $this->externalSorts() : []);
            $query = $query->allowedSorts($sorts);
        }

        if (isset($params['include'])) {
            $query = $query->allowedIncludes($this->getIncludes());
        }

        if (isset($params['append'])) {
            $query = $query->allowedAppends($this->getAppends());
        }

        return $query->defaultSort('id')->{config('json-api-paginate.method_name')}();
    }

    // Combine all in one

    public function getAppends(): array
    {
        if (isset($this->appends)) {
            return $this->appends;
        }

        return [];
    }

    // Regular Search Filters

    private function getFilterable(): array
    {
        return array_merge($this->getSearchable(), $this->getExactSearch(), $this->getScopeSearch());
    }

    // Exact Search Filters

    private function getSearchable(): array
    {
        if (isset($this->searchable)) {
            return $this->searchable;
        }

        return $this->fields();
    }

    // Scope Search Filters

    private function fields(): array
    {
        if ($this->getFillable() !== null) {
            return array_merge($this->getFillable(), ['id']);
        }
        return [];
    }

    // Merge All Filters

    private function getExactSearch(): array
    {
        $filters = [];

        if (isset($this->exactsearch)) {
            foreach ($this->exactsearch as $exactsearch) {
                $filters[] = AllowedFilter::exact($exactsearch);
            }
        }

        return $filters;
    }

    // Get Fields which can be sorted

    private function getScopeSearch()
    {
        $filters = [];

        if (isset($this->scopefilter)) {
            foreach ($this->scopefilter as $scopefilter) {
                $filters[] = AllowedFilter::scope($scopefilter);
            }
        }

        return $filters;
    }

    // Relationships which are allowed to included

    private function getSortable(): array
    {
        if (isset($this->sortable)) {
            return $this->sortable;
        }

        return $this->fields();
    }

    // Things to append into requests

    private function getIncludes(): array
    {
        $includes = [];

        if (isset($this->includes)) {
            $includes = array_merge($includes, $this->includes);
        }

        if (isset($this->with)) {
            $includes = array_merge($includes, $this->with);
        }
        return $includes;
    }
}
