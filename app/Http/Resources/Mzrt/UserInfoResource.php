<?php

namespace App\Http\Resources\Mzrt;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\UserInfo */
class UserInfoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'document' => $this->document,
            'identity_registry' => $this->identity_registry,
            'avatar' => $this->avatar,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'where_know_us' => $this->where_know_us,
            'source' => $this->source,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'country_id' => $this->country_id,
            'timezone' => TimezoneResource::make($this->whenLoaded('timezone')),
            'language' => LanguageResource::make($this->whenLoaded('language')),
        ];
    }
}
