<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Response;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class ResponseObserver extends QRFeedzObserver
{
    public function saving(Response $model)
    {
        //
    }
}
