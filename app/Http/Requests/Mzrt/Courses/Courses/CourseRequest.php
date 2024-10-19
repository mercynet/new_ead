<?php

namespace App\Http\Requests\Mzrt\Courses\Courses;

use App\Enums\CourseLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'order' => ['nullable', 'integer'],
            'name' => ['required', 'string'],
            'slug' => ['required', Rule::unique('courses')->ignore($this->course)],
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
            'course_modules' => ['required', 'array'],
            'course_modules.*.language_id' => ['sometimes', 'required'],
            'course_modules.*.name' => ['sometimes', 'required'],
            'course_modules.*.slug' => [
                'sometimes',
                'required',
                Rule::unique('course_modules', 'slug')->ignore($this->course)
            ],
            'course_modules.*.lessons' => ['required', 'array'],
            'course_modules.*.lessons.*.order' => ['required', 'integer'],
            'course_modules.*.lessons.*.name' => ['required', 'string'],
            'course_modules.*.lessons.*.slug' => ['required', 'string'],
            'course_modules.*.lessons.*.video_type' => ['required', 'string'],
            'course_modules.*.lessons.*.video_path' => ['required', 'string'],
            'course_modules.*.lessons.*.video_duration' => ['required', 'string'],
            'course_modules.*.lessons.*.video_downloadable' => ['required', 'boolean'],
            'course_modules.*.lessons.*.summary' => ['required', 'string'],
            'course_modules.*.lessons.*.description' => ['required', 'string'],
            'course_modules.*.lessons.*.image_featured' => ['required', 'string'],
            'course_modules.*.lessons.*.meta_description' => ['required', 'string'],
            'course_modules.*.lessons.*.meta_keywords' => ['required', 'string'],
            'course_modules.*.lessons.*.is_free' => ['required', 'boolean'],
            'course_modules.*.lessons.*.is_commentable' => ['required', 'boolean'],
            'course_modules.*.lessons.*.active' => ['required', 'boolean'],
            'course_modules.*.lessons.*.started_at' => ['required', 'date'],
            'course_modules.*.lessons.*.ended_at' => ['required', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function bodyParameters(): array
    {
        return [
            'order' => [
                'description' => 'The order of the course.',
                'example' => 1,
            ],
            'name' => [
                'description' => 'The name of the course.',
                'example' => 'Mastering Laravel 11',
            ],
            'slug' => [
                'description' => 'The slug of the course.',
                'example' => 'mastering-laravel-11',
            ],
            'level' => [
                'description' => 'The level of the course.',
                'example' => 'intermediate',
            ],
            'description' => [
                'description' => 'The description of the course.',
                'example' => 'A comprehensive course on mastering Laravel 11.',
            ],
            'pre_requisites' => [
                'description' => 'The pre-requisites for the course.',
            ],
            'target' => [
                'description' => 'The target audience for the course.',
                'example' => 'Developers looking to enhance their Laravel skills.',
            ],
            'image_featured' => [
                'description' => 'The featured image URL for the course.',
            ],
            'image_cover' => [
                'description' => 'The cover image URL for the course.',
            ],
            'is_fifo' => [
                'description' => 'Whether the course is FIFO.',
                'example' => false,
            ],
            'active' => [
                'description' => 'Whether the course is active.',
                'example' => true,
            ],
            'meta_description' => [
                'description' => 'The meta description for the course.',
                'example' => 'Learn advanced Laravel 11 techniques.',
            ],
            'meta_keywords' => [
                'description' => 'The meta keywords for the course.',
                'example' => 'Laravel, PHP, web development',
            ],
            'price' => [
                'description' => 'The price of the course.',
                'example' => 199.99,
            ],
            'access_months' => [
                'description' => 'The number of months the course is accessible.',
                'example' => 12,
            ],
            'started_at' => [
                'description' => 'The start date of the course.',
                'example' => '2024-10-19T11:22:20',
            ],
            'ended_at' => [
                'description' => 'The end date of the course.',
                'example' => '2025-10-19T11:22:20',
            ],
            'amount' => [
                'description' => 'The amount of the course.',
                'example' => 100,
            ],
            'discount' => [
                'description' => 'The discount on the course.',
                'example' => 20.00,
            ],
            'level_description' => [
                'description' => 'The level description of the course.',
            ],
            'course_modules' => [
                'description' => 'The modules of the course.',
            ],
            'course_modules.*.language_id' => [
                'description' => 'The language ID of the module.',
                'example' => 1,
            ],
            'course_modules.*.name' => [
                'description' => 'The name of the module.',
                'example' => 'Advanced Routing Techniques',
            ],
            'course_modules.*.slug' => [
                'description' => 'The slug of the module.',
                'example' => 'advanced-routing-techniques',
            ],
            'course_modules.*.lessons' => [
                'description' => 'The lessons of the module.',
            ],
            'course_modules.*.lessons.*.order' => [
                'description' => 'The order of the lesson.',
                'example' => 1,
            ],
            'course_modules.*.lessons.*.name' => [
                'description' => 'The name of the lesson.',
                'example' => 'Route Model Binding',
            ],
            'course_modules.*.lessons.*.slug' => [
                'description' => 'The slug of the lesson.',
                'example' => 'route-model-binding',
            ],
            'course_modules.*.lessons.*.video_type' => [
                'description' => 'The video type of the lesson.',
                'example' => 'mp4',
            ],
            'course_modules.*.lessons.*.video_path' => [
                'description' => 'The video path of the lesson.',
                'example' => '/videos/route-model-binding.mp4',
            ],
            'course_modules.*.lessons.*.video_duration' => [
                'description' => 'The video duration of the lesson.',
                'example' => '10:00',
            ],
            'course_modules.*.lessons.*.video_downloadable' => [
                'description' => 'Whether the video is downloadable.',
                'example' => true,
            ],
            'course_modules.*.lessons.*.summary' => [
                'description' => 'The summary of the lesson.',
                'example' => 'Learn how to use route model binding in Laravel.',
            ],
            'course_modules.*.lessons.*.description' => [
                'description' => 'The description of the lesson.',
                'example' => 'This lesson covers the basics of route model binding in Laravel.',
            ],
            'course_modules.*.lessons.*.image_featured' => [
                'description' => 'The featured image URL of the lesson.',
                'example' => '/images/route-model-binding.jpg',
            ],
            'course_modules.*.lessons.*.meta_description' => [
                'description' => 'The meta description of the lesson.',
                'example' => 'Learn route model binding in Laravel.',
            ],
            'course_modules.*.lessons.*.meta_keywords' => [
                'description' => 'The meta keywords of the lesson.',
                'example' => 'Laravel, routing, model binding',
            ],
            'course_modules.*.lessons.*.is_free' => [
                'description' => 'Whether the lesson is free.',
                'example' => true,
            ],
            'course_modules.*.lessons.*.is_commentable' => [
                'description' => 'Whether the lesson is commentable.',
                'example' => true,
            ],
            'course_modules.*.lessons.*.active' => [
                'description' => 'Whether the lesson is active.',
                'example' => true,
            ],
            'course_modules.*.lessons.*.started_at' => [
                'description' => 'The start date of the lesson.',
                'example' => '2024-10-19T11:22:20',
            ],
            'course_modules.*.lessons.*.ended_at' => [
                'description' => 'The end date of the lesson.',
                'example' => '2025-10-19T11:22:20',
            ],
        ];
    }
}
