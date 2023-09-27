<?php

namespace App\Http\Requests\Mzrt\Users\Students;

use Illuminate\Foundation\Http\FormRequest;

class StudentPointRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'points' => ['required', 'numeric','min:1']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
