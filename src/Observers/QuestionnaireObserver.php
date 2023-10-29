<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\OpenAIPrompt;
use QRFeedz\Cube\Models\Questionnaire;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class QuestionnaireObserver extends QRFeedzObserver
{
    public function created(Questionnaire $model)
    {
        /**
         * Each questionnaire creation will have an AI Prompt also
         * automatically created.
         */
        $openAIPrompt = new OpenAIPrompt();

        $openAIPrompt->questionnaire_id = $model->id;
        $openAIPrompt->prompt_i_am_a_business_of = 'a '.
                                                   $model->category->name.
                                                   'in '.
                                                   $model->location->locality;
        $openAIPrompt->prompt_i_am_paying_attention_to = 'client overall satisfaction';
        $openAIPrompt->balance_type = 'balanced';
        $openAIPrompt->should_be_email_aware = true;

        $openAIPrompt->saveQuietly();
    }

    public function saving(Questionnaire $model)
    {
        $this->validate($model, [
            'name' => 'required',
            'title' => 'required',
            //'color_primary' => 'required',
            //'color_secondary' => 'required',
            //'uuid' => 'required',
        ]);
    }

    public function deleting(Questionnaire $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model).' cannot be deleted');
        }
    }

    public function forceDeleting(Questionnaire $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model).' is not soft deleted first');
        }
    }
}
