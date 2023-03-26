<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => [
                'required',
                'email',
                'max:254',
                Rule::unique('users')
            ],
            'password' => ['required', Password::defaults(),
                'confirmed'
            ],
            'password_confirmation' => ['required']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
