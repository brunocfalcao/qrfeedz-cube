<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Tag;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class TagObserver extends QRFeedzObserver
{
    public function saving(Tag $model)
    {
        //
    }
}
