<?php

namespace App\Http\Requests\Mzrt\Users;

use App\Enums\Users\Gender;
use App\Enums\Users\Role;
use App\Rules\PostalCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'string', Rule::unique('users')->ignore($this->user)],
            'password' => ['nullable', Rule::requiredIf(request()->isMethod('POST')), Password::defaults(), 'confirmed'],
            'role' => ['required'],
            'group_id' => ['nullable'],
            'document' => ['required', Rule::unique('user_infos')->ignore($this->user?->user_info)],
            'identity_registry' => ['required', Rule::unique('user_infos')->ignore($this->user?->user_info)],
            'avatar' => ['nullable'],
            'birth_date' => ['required', 'date_format:d/m/Y'],
            'gender' => ['required', Rule::in(Gender::toArray())],
            'where_know_us' => ['nullable', 'string'],
            'source' => ['sometimes', 'required'],
            'nickname' => ['nullable'],
            'active' => ['sometimes', 'required'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'password' => [
                'description' => 'Must contain at least one uppercase and one lowercase letter; must contain at least one symbol; must contain at least one number',
                'example' => 'H3u3h#H%#ywQEG.'
            ]
        ];
    }
}
