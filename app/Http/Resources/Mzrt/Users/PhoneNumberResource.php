<?php

namespace App\Http\Resources\Mzrt\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Users\PhoneNumber */
class PhoneNumberResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas('id'),
            'name' => $this->whenHas('name'),
            'country_code' => $this->whenHas('country_code'),
            'area_code' => $this->whenHas('area_code'),
            'phone_number' => $this->whenHas('phone_number'),
            'type' => $this->type->name,
            'type_description' => $this->type->label(),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'user_id' => $this->whenHas('user_id'),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
