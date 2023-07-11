<?php

namespace App\Http\Requests\Mzrt;

use App\Enums\Users\Gender;
use App\Enums\Users\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInstructorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['reqiured', 'exists:users,id'],
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
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
