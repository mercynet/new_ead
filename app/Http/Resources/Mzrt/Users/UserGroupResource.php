<?php

namespace App\Http\Resources\Mzrt\Users;

use App\Models\Users\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Group */
class UserGroupResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas('id'),
            'name' => $this->whenHas('name'),
            'discount' => $this->whenHas('discount'),
            'commission' => $this->whenHas('commission'),
            'users' => UserResource::collection($this->whenLoaded('users')),
        ];
    }

    public function with($request): array
    {
        return [
            'success' => true,
        ];
    }
}
