<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCEPService
{
    /**
     * The base url for viacep API
     */
    protected string $baseUrl = 'http://viacep.com.br/ws';

    /**
     * Get Address Information by Postal Code
     */
    public function addressByPostalCode(string $postalCode): ?array
    {
        $response = Http::get("{$this->baseUrl}/{$postalCode}/json");

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
