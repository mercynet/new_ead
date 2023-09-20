<?php

namespace App\Services\Users;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Carbon;

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
        if (!empty($userInfo['address'])) {
            $userInfo['address_id'] = (new AddressService())->create($userInfo['address'], $this->user);
        }
        $userInfo['birth_date'] = !empty($userInfo['birth_date']) ? Carbon::createFromFormat('d/m/Y', $userInfo['birth_date'])->format('Y-m-d') : null;
        return UserInfo::create([
            'user_id' => $this->user->id,
            'address_id' => $userInfo['address_id'] ?? null,
            'timezone_id' => $userInfo['timezone_id'],
            'document' => justNumbers($userInfo['document']),
            'identity_registry' => justNumbers($userInfo['identity_registry']),
            'avatar' => $userInfo['avatar'] ?? null,
            'birth_date' => $userInfo['birth_date'],
            'gender' => $userInfo['gender'] ?? 'male',
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
        if (!$userInfo) {
            return $this->create($info);
        }
        $userInfo->update([
            'user_id' => $this->user->id,
            'address_id' => $info['address_id'],
            'timezone_id' => $info['timezone_id'],
            'document' => justNumbers($info['document']),
            'identity_registry' => justNumbers($info['identity_registry']),
            'avatar' => $info['avatar'] ?? null,
            'birth_date' => Carbon::createFromFormat('d/m/Y', $info['birth_date'])->format('Y-m-d'),
            'gender' => $info['gender'] ?? 'male',
            'where_know_us' => $info['where_know_us'] ?? null,
        ]);
        return true;
    }
}
