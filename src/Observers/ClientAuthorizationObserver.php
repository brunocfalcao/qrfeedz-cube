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

        /**
         * Is this client/user/authorization already existing?
         */
        if (ClientAuthorization::where('client_id', $model->client_id)
                               ->where('user_id', $model->user_id)
                               ->where('authorization_id', $model->authorization_id)
                               ->exists()
        ) {
            throw new \Exception('User already has this authorization');
        }
    }
}
