<?php

namespace App\Observers\Users;

use App\Models\Users\User;

class UserObserver
{
    public function created(User $user): void
    {

    }

    public function updated(User $user): void
    {
    }

    public function saving(User $user): void
    {
        $user->active = (int)$user->active;
        if(!empty($user->password)) {
            $user->password = bcrypt($user->password);
        }
        $user->saveQuietly();
    }

    public function deleted(User $user): void
    {
    }

    public function restored(User $user): void
    {
    }
}
