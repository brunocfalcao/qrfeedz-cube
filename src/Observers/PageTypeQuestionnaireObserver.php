<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Pivots\PageTypeQuestionnaire;

class PageTypeQuestionnaireObserver
{
    public function saving(PageTypeQuestionnaire $model)
    {
        if (blank($model->index)) {
            $model->incrementByGroup(['questionnaire_id', 'group']);
        }
    }
}
