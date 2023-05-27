<?php

namespace QRFeedz\Cube\Observers;

use Illuminate\Support\Facades\Auth;
use QRFeedz\Cube\Models\User;

class UserObserver
{
    public function saving(User $user)
    {
        /**
         * The attribute "is_admin" can only be changed by users that are
         * super admins (in case there is a logged session).
         */
        if (Auth::user()) {
            if ($user->isDirty('is_admin') && ! Auth::user()->is_admin) {
                throw \Exception('The attribute is_admin can only be changed by super admins');
            }
        }
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
