<?php

namespace App\Http\Requests\Mzrt;

use Illuminate\Foundation\Http\FormRequest;

class ActivateInstructorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'commission' => ['required', 'integer'],
            'bank_iban' => ['nullable'],
            'bank_name' => ['nullable'],
            'identify_image' => ['nullable'],
            'financial_approved' => ['required'],
            'available_meetings' => ['required'],
            'sex_meetings' => ['required'],
            'meeting_type' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
