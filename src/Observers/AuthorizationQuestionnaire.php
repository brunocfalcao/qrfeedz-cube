<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\AuthorizationQuestionnaire;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class AuthorizationQuestionnaireObserver extends QRFeedzObserver
{
    public function saving(AuthorizationQuestionnaire $model)
    {
        //
    }
}
