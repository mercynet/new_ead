<?php

namespace App\Http\Resources\Mzrt\Users;

use App\Http\Resources\Mzrt\Courses\CourseResource;
use App\Http\Resources\Mzrt\Users\StudentResource;
use App\Models\Users\User;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->whenHas('id'),
            'name' => $this->whenHas('name'),
            'email' => $this->whenHas('email'),
            'active' => $this->whenHas('active'),
            'type' => $this->whenHas('type'),
            'group_id' => $this->whenHas('group_id'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'roles' => $this->whenLoaded('roles'),
            'user_info' => UserInfoResource::make($this->whenLoaded('user_info')),
            'instructor' => InstructorResource::make($this->whenLoaded('instructor')),
            'student' => StudentResource::make($this->whenLoaded('student')),
            'group' => GroupResource::make($this->whenLoaded('group')),
            'addresses' => AddressResource::collection($this->whenLoaded('addresses')),
            'phone_numbers' => PhoneNumberResource::collection($this->whenLoaded('phone_numbers')),
            'courses' => CourseResource::collection($this->whenLoaded('courses')),
        ];
    }
}
