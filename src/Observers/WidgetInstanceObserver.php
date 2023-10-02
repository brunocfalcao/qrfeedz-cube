<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\WidgetInstance;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class WidgetInstanceObserver extends QRFeedzObserver
{
    public function saving(WidgetInstance $model)
    {
        //
    }
}
