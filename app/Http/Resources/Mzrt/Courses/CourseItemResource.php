<?php

namespace App\Http\Resources\Mzrt\Courses;

use App\Models\Courses\CourseItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin CourseItem */
class CourseItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas('id'),
            'course_id' => $this->whenHas('course_id'),
            'name' => $this->whenHas('name'),
            'active' => $this->whenHas('active'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'course' => CourseResource::make($this->whenLoaded('course')),
        ];
    }
}
