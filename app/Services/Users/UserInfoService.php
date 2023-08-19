<?php

namespace App\Services\Users;

use App\Models\User;
use App\Models\UserInfo;

/**
 *
 */
readonly class UserInfoService
{
    /**
     * @param User $user
     */
    public function __construct(private User $user)
    {
        //
    }

    /**
     * @param array $userInfo
     * @return UserInfo
     */
    public function create(array $userInfo): UserInfo
    {
        return UserInfo::create([
            'user_id' => $this->user->id,
            'address_id' => $userInfo['address_id'] ?? null,
            'timezone_id' => $userInfo['timezone_id'] ?? null,
            'document' => $userInfo['document'] ?? null,
            'identity_registry' => $userInfo['identity_registry'] ?? null,
            'avatar' => $userInfo['avatar'] ?? null,
            'birth_date' => $userInfo['birth_date'] ?? null,
            'gender' => $userInfo['gender'] ?? 'm',
            'where_know_us' => $userInfo['where_know_us'] ?? null,
            'source' => $userInfo['source'] ?? 'site',
        ]);
    }

    /**
     * @param array $info
     * @return UserInfo|true
     */
    public function update(array $info): UserInfo|true
    {
        $userInfo = UserInfo::where(['user_id' => $this->user->id])->first();
        if(!$userInfo) {
            return $this->create($info);
        }
        $userInfo->update($info);
        return true;
    }
}
