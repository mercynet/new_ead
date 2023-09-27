<?php

namespace App\Http\Requests\Mzrt\Users\Students;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nickname' => ['nullable'],
            'points' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
