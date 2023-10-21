<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\QuestionnaireAuthorization;
use QRFeedz\Cube\Models\User;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class QuestionnaireAuthorizationObserver extends QRFeedzObserver
{
    public function saving(QuestionnaireAuthorization $model)
    {
        $this->validate($model, [
            'questionnaire_id' => 'required',
            'authorization_id' => 'required',
            'user_id' => 'required',
        ]);

        /**
         * An user cannot be added to a questionnaire  authorization in case that
         * user doesn't belong to that client questionnaire.
         */
        $user = User::firstWhere('id', $model->user_id);

        if (! $user->client) {
            throw new \Exception('User is not associated with a client');
        }

        if (! $user->client->questionnaires->contains('id', $model->questionnaire_id)) {
            throw new \Exception('Questionnaire not part of the user client');
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

    public function deleting(QuestionnaireAuthorization $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception('Authorization model cannot be deleted');
        }
    }

    public function forceDeleting(QuestionnaireAuthorization $model)
    {
        if (! $model->trashed()) {
            throw new \Exception('Authorization model is not soft deleted first');
        }
    }
}
