<?php

namespace QRFeedz\Cube\Observers;

use Illuminate\Support\Str;
use QRFeedz\Cube\Models\Questionnaire;

class QuestionnaireObserver
{
    /**
     * Handle the Questionnaire "saving" event.
     */
    public function saving(Questionnaire $questionnaire): void
    {
        //
    }

    /**
     * Handle the Questionnaire "created" event.
     */
    public function created(Questionnaire $questionnaire): void
    {
        //
    }

    /**
     * Handle the Questionnaire "updated" event.
     */
    public function updated(Questionnaire $questionnaire): void
    {
        //
    }

    /**
     * Handle the Questionnaire "deleted" event.
     */
    public function deleted(Questionnaire $questionnaire): void
    {
        //
    }

    /**
     * Handle the Questionnaire "restored" event.
     */
    public function restored(Questionnaire $questionnaire): void
    {
        //
    }

    /**
     * Handle the Questionnaire "force deleted" event.
     */
    public function forceDeleted(Questionnaire $questionnaire): void
    {
        //
    }
}
