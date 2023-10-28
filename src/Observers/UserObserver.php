<?php

namespace QRFeedz\Cube\Observers;

use Illuminate\Support\Facades\Auth;
use QRFeedz\Cube\Models\User;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;
use QRFeedz\Services\Jobs\Users\ResetUserPasswordJob;

class UserObserver extends QRFeedzObserver
{
    public function saving(User $user)
    {
        $this->validate($model, [
            'name' => 'required',
            'email' => 'required',
        ]);

        if (! app()->runningInConsole()) {
            /**
             * "is_admin" and "is_super_admin" attributes can only be changed by
             * a super admin user role.
             */
            if ($user->isDirty('is_admin') || $user->isDirty('is_super_admin')) {
                if (! Auth::user()) {
                    throw new \Exception('User admin attributes can only be changed by a super admin user profile');
                }

                if (Auth::user() && ! Auth::user()->isSuperAdmin()) {
                    throw new \Exception('User admin attributes can only be changed by a super admin user profile');
                }
            }
        }

        // Send reset password email if password is blank.
        if (blank($user->password) || ! isset($user->password)) {
            ResetUserPasswordJob::dispatch($user->id, true);
        }
    }

    public function deleting(User $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model).' cannot be deleted');
        }
    }

    public function forceDeleting(User $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model).' is not soft deleted first');
        }
    }
}
