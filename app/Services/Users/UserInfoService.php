<?php

namespace App\Services\Users;

use App\Models\User;
use App\Models\UserInfo;

class UserInfoService
{
    /**
     * @param User $user
     */
    public function __construct(private User $user)
    {
        //
    }

    public function create($userData)
    {
        return UserInfo::create([
            'user_id' => $this->user->id,
            'address_id' => $userData['address_id'] ?? null,
            'timezone_id' => $userData['timezone_id'] ?? null,
            'document' => $userData['document'] ?? null,
            'identity_registry' => $userData['identity_registry'] ?? null,
            'avatar' => $userData['avatar'] ?? null,
            'birth_date' => $userData['birth_date'] ?? null,
            'gender' => $userData['gender'] ?? 'm',
            'where_know_us' => $userData['where_know_us'] ?? null,
            'source' => $userData['source'] ?? 'site',
        ]);
    }
}
