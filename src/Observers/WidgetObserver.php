<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Widget;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class WidgetObserver extends QRFeedzObserver
{
    public function saving(Widget $model)
    {
        //
    }
}
