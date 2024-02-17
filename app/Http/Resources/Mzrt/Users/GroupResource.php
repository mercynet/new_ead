<?php

namespace App\Http\Resources\Mzrt\Users;

use App\Models\Users\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Group */
class GroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas('id'),
            'name' => $this->whenHas('name'),
            'discount' => $this->whenHas('discount'),
            'commission' => $this->whenHas('commission'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'users' => UserResource::collection($this->whenLoaded('users')),
            'users_count' => $this->users_count ?? 0,
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
