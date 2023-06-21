<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 *
 */
class LoginRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:254'],
            'password' => [
                'required',
                Password::defaults(),
            ],
            'remember' => ['boolean'],
        ];
    }

    /**
     * @return array[]
     */
    public function bodyParameters(): array
    {
        return [
            'password' => [
                'description' => 'Must contain at least one uppercase and one lowercase letter; must contain at least one symbol; must contain at least one number',
                'example' => 'H3u3h#H%#ywQEG.'
            ]
        ];
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
