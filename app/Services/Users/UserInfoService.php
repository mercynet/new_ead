<?php

namespace App\Services\Users;

use App\Models\Users\User;
use App\Models\Users\UserInfo;
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
     * @param array $data
     * @return UserInfo
     */
    public function create(array $data): UserInfo
    {
        $data['user_id'] = $this->user->id;
        return UserInfo::create($data);
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
        if (!empty($data['address'])) {
            $data['address_id'] = (new AddressService())->create($data['addresses'], $this->user)->id;
        }
        $userInfo->update([
            'user_id' => $this->user->id,
            'address_id' => $info['address_id'],
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
