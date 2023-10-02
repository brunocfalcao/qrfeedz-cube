<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\QuestionInstance;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class QuestionInstanceObserver extends QRFeedzObserver
{
    public function saving(QuestionInstance $model)
    {
        $model->index = $model->incrementByGroup('page_instance_id');
    }
}
