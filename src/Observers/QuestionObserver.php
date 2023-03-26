<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Question;

class QuestionObserver
{
    public function saving(Question $model): void
    {
        if (blank($model->index)) {
            $model->incrementByGroup('page_id');
        }
    }
}
