<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\OpenAIPrompt;
use QRFeedz\Cube\Models\Questionnaire;

class QuestionnaireObserver
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
        //
    }
}
