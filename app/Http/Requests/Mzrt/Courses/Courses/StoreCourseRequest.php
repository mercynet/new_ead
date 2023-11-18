<?php

namespace App\Http\Requests\Mzrt\Courses\Courses;

use App\Enums\CourseLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'order' => ['nullable', 'integer'],
            'name' => ['required', 'string'],
            'slug' => ['required', Rule::unique('courses')],
            'level' => ['required', Rule::in(CourseLevel::toArray())],
            'description' => ['nullable', 'string'],
            'pre_requisites' => ['nullable', 'array'],
            'target' => ['nullable', 'string'],
            'image_featured' => ['nullable'],
            'image_cover' => ['nullable'],
            'is_fifo' => ['required', 'boolean'],
            'active' => ['required', 'boolean'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'access_months' => ['nullable', 'integer'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date'],
            'amount' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'level_description' => ['nullable'],
            'course_module.*.language_id' => ['sometimes', 'required'],
            'course_module.*.name' => ['sometimes', 'required'],
            'course_module.*.slug' => ['sometimes', 'required', 'unique:course_modules,slug'],
            'lesson.*.order' => ['sometimes', 'required'],
            'lesson.*.name' => ['sometimes', 'required'],
            'lesson.*.slug' => ['sometimes', 'required'],
            'lesson.*.video_type' => ['sometimes', 'required'],
            'lesson.*.video_path' => ['sometimes', 'required'],
            'lesson.*.video_duration' => ['sometimes', 'required'],
            'lesson.*.video_downloadable' => ['sometimes', 'required'],
            'lesson.*.summary' => ['sometimes', 'required'],
            'lesson.*.description' => ['sometimes', 'required'],
            'lesson.*.image_featured' => ['sometimes', 'required'],
            'lesson.*.meta_description' => ['sometimes', 'required'],
            'lesson.*.meta_keywords' => ['sometimes', 'required'],
            'lesson.*.is_free' => ['sometimes', 'required'],
            'lesson.*.is_commentable' => ['sometimes', 'required'],
            'lesson.*.active' => ['sometimes', 'required'],
            'lesson.*.started_at' => ['sometimes', 'required'],
            'lesson.*.ended_at' => ['sometimes', 'required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
