<?php

namespace App\Http\Resources\Mzrt;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->whenHas('id'),
            'name' => $this->whenHas('name'),
            'email' => $this->whenHas('email'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'active' => $this->whenHas('active'),
            'group_id' => $this->whenHas('group_id'),
            'roles' => $this->whenLoaded('roles'),
            'user_info' => UserInfoResource::make($this->whenLoaded('user_info')),
            'instructor' => InstructorResource::make($this->whenLoaded('instructor')),
            'student' => StudentResource::make($this->whenLoaded('student')),
            'group' => GroupResource::make($this->whenLoaded('group')),
            'addresses' => AddressResource::collection($this->whenLoaded('addresses')),
        ];
    }

    /**
     * @param $request
     * @return true[]
     */
    public function with($request): array
    {
        return ['success' => true];
    }
}
