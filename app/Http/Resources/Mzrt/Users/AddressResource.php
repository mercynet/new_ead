<?php

namespace App\Http\Resources\Mzrt\Users;

use App\Models\Users\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Address */
class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'zip_code' => $this->zip_code,
            'address' => $this->address,
            'number' => $this->number,
            'complement' => $this->complement,
            'district' => $this->district,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'user' => UserResource::make($this->whenLoaded('user')),
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
