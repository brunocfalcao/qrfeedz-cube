<?php

namespace QRFeedz\Cube\Observers;

class PageTypeQuestionnaireObserver
{
    public function saving(PageTypeQuestionnaire $model): void
    {
        if (blank($model->index)) {
            $model->incrementByGroup(['questionnaire_id', 'group']);
        }
    }
}
