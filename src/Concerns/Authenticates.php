<?php

namespace QRFeedz\Cube\Concerns;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
    public function getPasswordResetLink($invalidate = false)
    {
        // Remove any entries from the password reset table for this user.
        DB::table('password_reset_tokens')
          ->where('email', $this->email)
          ->delete();

        // Invalidate password if necessary.
        if ($invalidate) {
            $this->invalidatePassword();
        }

        // Obtain a new password reset token.
        $token = Password::broker()->createToken($this);
        $resetLink = route('password.reset', ['token' => $token]);

        return $resetLink;
    }

    /**
     * Invalidates the user password.
     *
     * @return void
     */
    public function invalidatePassword()
    {
        $this->update([
            'password' => Hash::make(Str::random(16)),
        ]);
    }
}
