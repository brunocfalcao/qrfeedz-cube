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
    public function saving(Question $question): void
    {
        $this->resolveIncrement($question, 'questionnaire_id');
    }

    /**
     * Handle the Question "created" event.
     */
    public function created(Question $question): void
    {
        //
    }

    /**
     * Handle the Question "updated" event.
     */
    public function updated(Question $question): void
    {
        //
    }

    /**
     * Handle the Question "deleted" event.
     */
    public function deleted(Question $question): void
    {
        //
    }

    /**
     * Handle the Question "restored" event.
     */
    public function restored(Question $question): void
    {
        //
    }

    /**
     * Handle the Question "force deleted" event.
     */
    public function forceDeleted(Question $question): void
    {
        //
    }
}
