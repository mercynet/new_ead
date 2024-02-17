<?php

namespace App\Http\Requests\Mzrt\Users\Groups;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserGroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique('groups', 'name')->ignore($this->group)],
            'discount' => ['nullable', 'decimal:2'],
            'commission' => ['nullable', 'decimal:2'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Group\'s name',
                'example' => 'Vip'
            ],
            'discount' => [
                'description' => 'User groups can have discounts. Type: decimal',
                'example' => fake()->randomFloat(2)
            ],
            'commission' => [
                'description' => 'User groups can have commissions. Type: decimal',
                'example' => fake()->randomFloat(2)
            ],
        ];
    }
}
