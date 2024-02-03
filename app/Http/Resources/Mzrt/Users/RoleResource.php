<?php

namespace App\Http\Resources\Mzrt\Users;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Role */
class RoleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas('id'),
            'name' => $this->whenHas('name'),
            'guard_name' => $this->whenHas('guard_name'),
            'group_name' => $this->whenHas('group_name'),
            'description' => $this->whenHas('description'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'users_count' => $this->whenHas('users_count'),
            'permissions' => $this->whenLoaded('permissions'),
        ];
    }
}
