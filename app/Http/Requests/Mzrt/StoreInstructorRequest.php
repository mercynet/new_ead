<?php

namespace App\Http\Requests\Mzrt;

use App\Enums\Users\Gender;
use App\Enums\Users\MeetingType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInstructorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'commission' => ['required', 'integer'],
            'bank_iban' => ['nullable'],
            'bank_name' => ['nullable'],
            'identify_image' => ['nullable'],
            'financial_approved' => ['nullable', 'boolean'],
            'available_meetings' => ['nullable', 'boolean'],
            'sex_meetings' => ['required', Rule::in(Gender::toArray())],
            'meeting_type' => ['required', Rule::in(MeetingType::toArray())],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
