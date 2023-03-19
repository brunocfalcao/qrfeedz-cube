<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Concerns\ConcernsAutoIncrements;
use QRFeedz\Cube\Models\Question;

class QuestionObserver
{
    use ConcernsAutoIncrements;

    /**
     * Handle the Question "saving" event.
     */
    public function saving(Question $model): void
    {
        if (blank($model->index)) {
            $this->resolveIncrement($model, 'questionnaire_id');
        }
    }

    /**
     * Handle the Question "created" event.
     */
    public function created(Question $model): void
    {
        //
    }

    /**
     * Handle the Question "updated" event.
     */
    public function updated(Question $model): void
    {
        //
    }

    /**
     * Handle the Question "deleted" event.
     */
    public function deleted(Question $model): void
    {
        //
    }

    /**
     * Handle the Question "restored" event.
     */
    public function restored(Question $model): void
    {
        //
    }

    /**
     * Handle the Question "force deleted" event.
     */
    public function forceDeleted(Question $model): void
    {
        //
    }
}
