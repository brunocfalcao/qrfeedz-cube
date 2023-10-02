<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Locale;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class LocaleObserver extends QRFeedzObserver
{
    public function saving(Locale $model)
    {
        //
    }
}
