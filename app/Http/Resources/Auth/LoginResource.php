<?php

namespace App\Http\Resources\Auth;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        if($this->roles) {
            $roles = $this->roles->pluck('name');
            $permissions = $this->roles->map(function ($role) {
                return $role->permissions->pluck('name');
            })->flatten();
        }
        return [
            'name'  => $this->name,
            'email'  => $this->email,
            'active'  => $this->active,
            'roles' => [
                'roles' => $roles ?? null,
                'permissions' => $permissions ?? null
            ],
        ];
    }
    public function with($request): array
    {
        return ['success' => true, 'api_token' => auth()->user()->createToken('api')->plainTextToken];
    }
}
