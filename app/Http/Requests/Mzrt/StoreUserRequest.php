<?php

namespace App\Http\Requests\Mzrt;

use App\Enums\Users\Gender;
use App\Enums\Users\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required', 'email', 'string', Rule::unique('users')],
            'password' => ['required', Password::defaults(), 'confirmed'],
            'role' => ['required', Rule::in(Role::toArray())],
            'address_id' => ['nullable', 'exists:addresses,id'],
            'timezone_id' => ['required', 'exists:timezones,id'],
            'group_id' => ['required', 'exists:groups,id'],
            'document' => ['required', Rule::unique('user_infos')],
            'identity_registry' => ['required', Rule::unique('user_infos')],
            'avatar' => ['nullable'],
            'birth_date' => ['required', 'date_format:d/m/Y'],
            'gender' => ['required'],
            'where_know_us' => ['nullable'],
            'roles' => ['required', Rule::in(Role::toArray())],
            'source' => ['sometimes', 'required'],
            'nickname' => ['nullable'],
            'active' => ['sometimes', 'required'],
        ];
    }
}
