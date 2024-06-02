<?php

namespace App\Http\Requests\Mzrt;

use App\Rules\Base64FileRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['nullable'],
            'name' => ['required'],
            'slug' => [
                'required',
                Rule::unique('categories', 'slug')->ignore($this->category)
            ],
            'order' => ['nullable'],
            'is_showcase' => ['boolean'],
            'active' => ['boolean'],
            'description' => ['nullable'],
            'image' => ['nullable', new Base64FileRule],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
