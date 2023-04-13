<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\PageTypeQuestionnaire;

class PageTypeQuestionnaireObserver
{
    public function saving(PageTypeQuestionnaire $model): void
    {
        dd('on observer');

        if (blank($model->index)) {
            $model->incrementByGroup(['questionnaire_id', 'group']);
        }
    }
}
