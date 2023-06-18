<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\QuestionInstance;

class QuestionInstanceObserver
{
    public function saving(QuestionInstance $model)
    {
        if (blank($model->index)) {
            $model->incrementByGroup('page_instance_id');
        }
    }
}
