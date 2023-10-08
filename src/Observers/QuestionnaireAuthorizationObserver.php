<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\QuestionnaireAuthorization;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class QuestionnaireAuthorizationObserver extends QRFeedzObserver
{
    public function saving(QuestionnaireAuthorization $model)
    {
        //
    }
}
