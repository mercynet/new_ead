<?php

namespace App\Http\Resources\Mzrt\Courses;

use App\Http\Resources\Mzrt\LanguageResource;
use App\Http\Resources\Mzrt\Users\UserResource;
use App\Models\Courses\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Course */
class CourseResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas('id'),
            'order' => $this->whenHas('order'),
            'name' => $this->whenHas('name'),
            'slug' => $this->whenHas('slug'),
            'level' => $this->whenHas('level'),
            'description' => $this->whenHas('description'),
            'pre_requisites' => $this->whenHas('pre_requisites'),
            'target' => $this->whenHas('target'),
            'image_featured' => $this->whenHas('image_featured'),
            'image_cover' => $this->whenHas('image_cover'),
            'is_fifo' => $this->whenHas('is_fifo'),
            'active' => $this->whenHas('active'),
            'meta_description' => $this->whenHas('meta_description'),
            'meta_keywords' => $this->whenHas('meta_keywords'),
            'price' => $this->whenHas('price'),
            'access_months' => $this->whenHas('access_months'),
            'started_at' => $this->whenHas('started_at'),
            'ended_at' => $this->whenHas('ended_at'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'amount' => $this->whenHas('amount'),
            'discount' => $this->whenHas('discount'),
            'level_description' => $this->whenHas('level_description'),
            'product_discount' => $this->whenHas('product_discount'),
            'product_price' => $this->whenHas('product_price'),
            'total' => $this->whenHas('total'),
            'formations_count' => $this->whenHas('formations_count'),
            'lessons_count' => $this->whenHas('lessons_count'),
            'modules_count' => $this->whenHas('modules_count'),
            'students' => UserResource::collection($this->whenLoaded('students')),
            'instructors' => UserResource::collection($this->whenLoaded('instructors')),
        ];
    }
}
