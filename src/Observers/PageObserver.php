<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Page;

class PageObserver
{
    public function saving(Page $model): void
    {
        if (blank($model->index)) {
            $model->incrementByGroup('questionnaire_id');
        }
    }
}
