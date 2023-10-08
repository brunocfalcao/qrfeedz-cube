<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\ClientAuthorization;
use QRFeedz\Cube\Models\User;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class ClientAuthorizationObserver extends QRFeedzObserver
{
    public function saving(ClientAuthorization $model)
    {
        /**
         * An user cannot be added to a client authorization in case that
         * user doesn't belong to that client.
         */
        $user = User::firstWhere('id', $model->user_id);

        if ($user->client_id != $model->client_id) {
            throw new \Exception('User is not associated with this client');
        }
    }
}
