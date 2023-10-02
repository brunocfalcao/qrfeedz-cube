<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\AuthorizationClient;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class AuthorizationClientObserver extends QRFeedzObserver
{
    public function saving(AuthorizationClient $model)
    {
        //
    }
}
