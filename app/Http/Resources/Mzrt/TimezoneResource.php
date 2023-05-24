<?php

namespace App\Http\Resources\Mzrt;

use App\Models\Timezone;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Timezone */
class TimezoneResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas('id'),
            'code' => $this->whenHas('code'),
            'name' => $this->whenHas('name'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
        ];
    }
}
