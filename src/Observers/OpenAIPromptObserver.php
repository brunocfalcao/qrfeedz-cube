<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\OpenAIPrompt;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class OpenAIPromptObserver extends QRFeedzObserver
{
    public function saving(OpenAIPrompt $model)
    {
        $this->validate($model, [
            'questionnaire_id' => 'required',
            'balance_type' => 'required',
            'should_be_email_aware' => 'required',
        ]);
    }

    public function deleting(OpenAIPrompt $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model).' cannot be deleted');
        }
    }

    public function forceDeleting(OpenAIPrompt $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model).' not soft deleted first');
        }
    }
}
