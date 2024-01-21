<?php

namespace App\Http\Requests\Mzrt;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable'],
            'zip_code' => ['required', 'postal_code:BR'],
            'address' => ['required'],
            'number' => ['required'],
            'complement' => ['nullable'],
            'district' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
