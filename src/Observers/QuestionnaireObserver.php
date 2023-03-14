<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Questionnaire;

class QuestionnaireObserver
{
    /**
     * Handle the Questionnaire "saving" event.
     */
    public function saving(Questionnaire $model): void
    {
        //
    }

    /**
     * Handle the Questionnaire "created" event.
     */
    public function created(Questionnaire $model): void
    {
        //
    }

    /**
     * Handle the Questionnaire "updated" event.
     */
    public function updated(Questionnaire $model): void
    {
        //
    }

    /**
     * Handle the Questionnaire "deleted" event.
     */
    public function deleted(Questionnaire $model): void
    {
        //
    }

    /**
     * Handle the Questionnaire "restored" event.
     */
    public function restored(Questionnaire $model): void
    {
        //
    }

    /**
     * Handle the Questionnaire "force deleted" event.
     */
    public function forceDeleted(Questionnaire $model): void
    {
        //
    }
}
