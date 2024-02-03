<?php

namespace App\Observers\Users;

use App\Enums\Source;
use App\Models\Users\UserInfo;
use Illuminate\Support\Carbon;

class UserInfoObserver
{
    public function created(UserInfo $userInfo): void
    {

    }

    public function updated(UserInfo $userInfo): void
    {
    }

    public function saving(UserInfo $userInfo): void
    {
        $birthDate = Carbon::createFromFormat('d/m/Y', $userInfo->birth_date)->format('Y-m-d');
        $userInfo->document = justNumbers($userInfo->document);
        $userInfo->identity_registry = justNumbers($userInfo->identity_registry);
        $userInfo->birth_date = $birthDate;
        $userInfo->source ??= Source::site->name;
        $userInfo->avatar = sanitizeFileName($userInfo->avatar);
        $userInfo->saveQuietly();
    }

    public function deleted(UserInfo $userInfo): void
    {
    }

    public function restored(UserInfo $userInfo): void
    {
    }
}
