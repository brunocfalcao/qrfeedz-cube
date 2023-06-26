<?php

namespace QRFeedz\Cube\Observers;

use Illuminate\Support\Facades\Auth;
use QRFeedz\Cube\Events\Users\UserCreated;
use QRFeedz\Cube\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        /**
         * Trigger user created event. Normally it will at least send an email
         * notification to the user to say that he was created in QRFeedz.
         */
        UserCreated::dispatch($user);
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
