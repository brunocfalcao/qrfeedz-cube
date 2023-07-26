<?php

namespace QRFeedz\Cube\Observers;

use Illuminate\Support\Facades\Auth;
use QRFeedz\Cube\Models\User;
use QRFeedz\Services\Jobs\Users\ResetUserPasswordJob;

class UserObserver
{
    public function created(User $user)
    {
        /**
         * If the password is blank, or inexisting, then send reset
         * password email.
         */
        if (blank($user->password) || ! isset($user->password)) {
            ResetUserPasswordJob::dispatch($user->id, true);
        }
    }

    public function saving(User $user)
    {
        /**
         * The attribute "is_admin" can only be changed by users that are
         * super admins (in case there is a user logged).
         */
        if (Auth::user()) {
            if ($user->isDirty('is_admin') && ! Auth::user()->is_super_admin) {
                throw \Exception('The attribute is_admin can only be changed by super admins');
            }
        }
    }
}
