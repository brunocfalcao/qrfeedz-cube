<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\PageTypeQuestionnaire;

class PageTypeQuestionnaireObserver
{
    public function saving(PageTypeQuestionnaire $model): void
    {
        if (blank($model->index)) {
            $model->incrementByGroup(['questionnaire_id', 'group']);
        }
    }
}
