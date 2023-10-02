<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\PageInstance;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class PageInstanceObserver extends QRFeedzObserver
{
    public function saving(PageInstance $model)
    {
        //
    }
}
