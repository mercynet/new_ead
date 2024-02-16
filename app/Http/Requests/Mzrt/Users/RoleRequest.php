<?php

namespace App\Http\Requests\Mzrt\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('roles')->where(function ($query) {
                    $guards = $this->input('guard_name');
                    if (is_string($guards)) {
                        return $query->where('guard_name', $guards);
                    }
                    foreach ($guards as $guard) {
                        return $query->where('guard_name', $guard);
                    }
                    return true;
                })->ignore($this->role)
            ],
            'guard_name' => ['required', Rule::when(request()->isMethod('POST'), 'array')],
            'group_name' => ['required'],
            'description' => ['nullable'],
            'permissions.*' => [Rule::requiredIf(request()->isMethod('PUT')), 'exists:permissions,id']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
