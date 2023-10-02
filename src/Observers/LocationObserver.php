<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Location;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class LocationObserver extends QRFeedzObserver
{
    public function saving(Location $model)
    {
        //
    }
}
