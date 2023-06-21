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
            'birth_date' => ['required'],
            'gender' => ['required'],
            'where_know_us' => ['nullable'],
            'source' => ['sometimes', 'required'],
            'nickname' => ['nullable'],
            'commission' => ['sometimes', Rule::requiredIf(request('role') === Role::instructor->name)],
            'bank_iban' => ['nullable'],
            'bank_name' => ['nullable'],
            'identify_image' => ['sometimes', Rule::requiredIf(request('role') === Role::instructor->name)],
            'financial_approved' => ['sometimes', Rule::requiredIf(request('role') === Role::instructor->name)],
            'available_meetings' => ['sometimes', Rule::requiredIf(request('role') === Role::instructor->name)],
            'sex_meetings' => [
                'nullable',
                Rule::requiredIf(request('role') === Role::instructor->name),
                Rule::in(Gender::toArray()),
            ],
            'meeting_type' => [
                'nullable',
                Rule::requiredIf(request('role') === Role::instructor->name),
                Rule::in(Gender::toArray()),
            ],
            'active' => ['sometimes', 'required'],
        ];
    }
}
