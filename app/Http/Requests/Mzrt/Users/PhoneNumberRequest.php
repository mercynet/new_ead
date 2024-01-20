<?php

namespace App\Http\Requests\Mzrt\Users;

use App\Enums\Users\PhoneNumberType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PhoneNumberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable'],
            'country_code' => ['required', 'integer'],
            'area_code' => ['required', 'integer'],
            'phone_number' => [
                'required',
                Rule::when(request()->type == 'mobile', 'celular', 'telefone')
            ],
            'type' => ['required', Rule::in(PhoneNumberType::toArray())],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
