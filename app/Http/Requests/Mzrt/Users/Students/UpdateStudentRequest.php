<?php

namespace App\Http\Requests\Mzrt\Users\Students;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nickname' => ['nullable'],
            'points' => ['required', 'integer'],
        ];
    }
}
