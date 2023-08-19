<?php

namespace App\Services;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 *
 */
class CountryService
{
    /**
     * @param Request|null $request
     * @param array $fields
     * @return Collection|null
     */
    public function getAll(?Request $request = null, array $fields = []): ?Collection
    {
        $countries = Country::query();
        if(!empty($fields)) {
            $countries->select($fields);
        }
        return $countries->get();
    }
}
