<?php

namespace App\Http\Resources\Mzrt;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'active' => $this->active,
            'group_id' => $this->group_id,
            'roles' => $this->whenLoaded('roles'),
            'user_info' => UserInfoResource::make($this->whenLoaded('userInfo')),
        ];
    }

    public function with($request): array
    {
        return ['success' => true];
    }
}
