<?php

namespace QRFeedz\Cube\Concerns;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

trait Authenticates
{
    /**
     * Resets an user password. Follows several options.
     *
     * @param  bool  $invalidate Immediately invalidate the password
     * @param  bool  $notify     Send the user a reset password notification
     * @return string            The password reset link.
     */
    public function getPasswordResetLink($invalidate = false, $notify = false)
    {
        if ($invalidate) {
            $this->update([
                'password' => bcrypt(Str::random(20)),
            ]);
        }

        $token = Password::getRepository()->create($this);
        $resetLink = route('password.reset', ['token' => $token]);

        if ($notify) {
        }

        return $resetLink;
    }
}
