<?php

namespace App\Http\Resources\Mzrt;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Language */
class LanguageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas('id'),
            'code' => $this->whenHas('code'),
            'name' => $this->whenHas('name'),
            'active' => $this->whenHas('active'),
            'locale' => $this->whenHas('locale'),
            'icon' => $this->whenHas('icon'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
        ];
    }
}
