<?php

namespace App\Http\Requests\Mzrt\Users;

use App\Enums\Users\Gender;
use App\Enums\Users\Role;
use App\Rules\Base64FileRule;
use App\Rules\PostalCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Nnjeim\World\WorldHelper;

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
            'role' => ['required'],
            'group_id' => ['required', 'exists:groups,id'],
            'document' => ['required', 'cpf_ou_cnpj', Rule::unique('user_infos')],
            'identity_registry' => ['required', Rule::unique('user_infos')],
            'avatar' => [
                'nullable',
                new Base64FileRule,
            ],
            'birth_date' => ['required', 'date_format:d/m/Y'],
            'gender' => ['required', Rule::in(Gender::toArray())],
            'where_know_us' => ['nullable'],
            'source' => ['required', 'string'],
            'nickname' => ['nullable'],
            'active' => ['sometimes', 'required', 'bool'],
        ];
    }
}
