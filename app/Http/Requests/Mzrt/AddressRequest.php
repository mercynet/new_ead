<?php

namespace App\Http\Requests\Mzrt;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable'],
            'zip_code' => ['required', 'int', 'postal_code:BR'],
            'address' => ['required'],
            'number' => ['required'],
            'complement' => ['nullable'],
            'district' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['zip_code' => justNumbers($this->zip_code)]);
    }

    public function authorize(): bool
    {
        return true;
    }
}
