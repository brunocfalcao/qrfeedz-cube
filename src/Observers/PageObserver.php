<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Page;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class PageObserver extends QRFeedzObserver
{
    public function saving(Page $model)
    {
        //
    }
}
