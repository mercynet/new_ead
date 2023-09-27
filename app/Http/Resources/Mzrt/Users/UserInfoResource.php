<?php

namespace App\Http\Resources\Mzrt\Users;

use App\Http\Resources\Mzrt\LanguageResource;
use App\Http\Resources\Mzrt\TimezoneResource;
use App\Models\Users\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin UserInfo */
class UserInfoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas('id'),
            'document' => $this->whenHas('document'),
            'identity_registry' => $this->whenHas('identity_registry'),
            'avatar' => $this->whenHas('avatar'),
            'birth_date' => $this->whenHas('birth_date'),
            'gender' => $this->gender->name,
            'gender_description' => $this->gender->label(),
            'where_know_us' => $this->whenHas('where_know_us'),
            'source' => $this->whenHas('source'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'timezone' => TimezoneResource::make($this->whenLoaded('timezone')),
            'language' => LanguageResource::make($this->whenLoaded('language')),
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
