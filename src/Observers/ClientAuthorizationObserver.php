<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\ClientAuthorization;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class ClientAuthorizationObserver extends QRFeedzObserver
{
    public function saving(ClientAuthorization $model)
    {
        //
    }
}
