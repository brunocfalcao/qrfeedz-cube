<?php

namespace QRFeedz\Cube\Events\Users;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use QRFeedz\Cube\Models\User;

/**
 * Event triggered when an user is created. Mostly it will send a welcome
 * notification to the user.
 */
class UserCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
