<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\PageInstance;

class PageInstanceObserver
{
    public function saving(PageInstance $model)
    {
        if (blank($model->index)) {
            $model->incrementByGroup(['questionnaire_id', 'group']);
        }
    }
}
