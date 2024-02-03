<?php

namespace App\Services\Users;

use App\Exceptions\InvalidUploadException;
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
     * @throws InvalidUploadException
     */
    public function create(array $data): UserInfo
    {
        if (!empty($data['avatar']) && preg_match('/^data:image\/(\w+);base64,/', $data['avatar'])) {
            $data['avatar'] = "users/" . prepareUpload($data['avatar'], 'users');
        }
        $userData = [
            'user_id' => $this->user->id,
            'document' => $data['document'],
            'identity_registry' => $data['identity_registry'],
            'avatar' => $data['avatar'] ?? null,
            'birth_date' => $data['birth_date'],
            'gender' => $data['gender'] ?? 'male',
            'where_know_us' => $data['where_know_us'] ?? null,
        ];
        return UserInfo::create($userData);
    }

    /**
     * @param array $info
     * @return UserInfo|true
     * @throws InvalidUploadException
     */
    public function update(array $info): UserInfo|true
    {
        $userInfo = UserInfo::where(['user_id' => $this->user->id])->first();
        if (!$userInfo) {
            return $this->create($info);
        }
        if (!empty($info['avatar']) && preg_match('/^data:image\/(\w+);base64,/', $info['avatar'])) {
            $info['avatar'] = "users/" . prepareUpload($info['avatar'], 'users');
        }
        $userInfo->update([
            'user_id' => $this->user->id,
            'document' => $info['document'],
            'identity_registry' => $info['identity_registry'],
            'avatar' => $info['avatar'] ?? null,
            'birth_date' => Carbon::createFromFormat('d/m/Y', $info['birth_date'])->format('d/m/Y'),
            'gender' => $info['gender'] ?? 'male',
            'where_know_us' => $info['where_know_us'] ?? null,
        ]);
        return true;
    }
}
