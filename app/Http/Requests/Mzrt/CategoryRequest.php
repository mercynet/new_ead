<?php

namespace App\Http\Requests\Mzrt;

use App\Rules\Base64FileRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['nullable', 'integer'],
            'name' => ['required'],
            'slug' => ['required'],
            'order' => ['nullable', 'integer'],
            'is_showcase' => ['boolean'],
            'active' => ['boolean'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', new Base64FileRule],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
