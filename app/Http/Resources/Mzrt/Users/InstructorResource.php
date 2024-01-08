<?php

namespace App\Http\Resources\Mzrt\Users;

use App\Models\Users\Instructor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Instructor */
class InstructorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenHas('id'),
            'commission' => $this->whenHas('commission'),
            'bank_iban' => $this->whenHas('bank_iban'),
            'bank_name' => $this->whenHas('bank_name'),
            'identify_image' => $this->whenHas('identify_image'),
            'financial_approved' => $this->whenHas('financial_approved'),
            'available_meetings' => $this->whenHas('available_meetings'),
            'sex_meetings' => $this->whenHas('sex_meetings'),
            'meeting_type' => $this->whenHas('meeting_type'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'user_id' => $this->whenHas('user_id'),
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
