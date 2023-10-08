<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\QuestionnaireAuthorization;
use QRFeedz\Cube\Models\User;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class QuestionnaireAuthorizationObserver extends QRFeedzObserver
{
    public function saving(QuestionnaireAuthorization $model)
    {
        /**
         * An user cannot be added to a questionnaire  authorization in case that
         * user doesn't belong to that client questionnaire.
         */
        $user = User::firstWhere('id', $model->user_id);

        if ($user->client_id != $user->client->id) {
            throw new \Exception('User is not associated with this client');
        }

        /**
         * Is this questionnaire/user/authorization already existing?
         */
        if (QuestionnaireAuthorization::where('questionnaire_id', $model->questionnaire_id)
                                      ->where('user_id', $model->user_id)
                                      ->where('authorization_id', $model->authorization_id)
                                      ->exists()
        ) {
            throw new \Exception('User already has this authorization');
        }
    }
}
