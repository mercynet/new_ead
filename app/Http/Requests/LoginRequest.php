<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:254'],
            'password' => [
                'required',
                Password::defaults(),
            ],
            'remember' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
