<?php

namespace App\Http\Resources\Mzrt;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Category */
class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas('id'),
            'category_id' => $this->whenHas('category_id'),
            'order' => $this->whenHas('order'),
            'is_showcase' => $this->whenHas('is_showcase'),
            'active' => $this->whenHas('active'),
            'name' => $this->whenHas('name'),
            'slug' => $this->whenHas('slug'),
            'description' => $this->whenHas('description'),
            'image' => $this->whenHas('image'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'subcategories_count' => $this->whenHas('categories_count'),
            'children' => CategoryResource::collection($this->whenLoaded('children')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
        ];
    }
}
