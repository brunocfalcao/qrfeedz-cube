<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\PageTypeQuestionnaire;

class PageTypeQuestionnaireObserver
{
    public function saving(PageTypeQuestionnaire $model): void
    {
        if (blank($model->index)) {
            dd($model);
            $model->incrementByGroup(['questionnaire_id', 'group']);
        }
    }
}
