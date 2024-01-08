<?php

namespace App\Http\Controllers\API\V1\Mzrt;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mzrt\CountryResource;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __invoke(Request $request)
    {
        return CountryResource::collection((new CountryService)->getAll($request));
    }
}
