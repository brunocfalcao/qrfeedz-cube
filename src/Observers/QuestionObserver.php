<?php

namespace QRFeedz\Cube\Observers;

use Illuminate\Support\Str;
use QRFeedz\Cube\Concerns\ConcernsAutoIncrements;
use QRFeedz\Cube\Concerns\ConcernsGroupUuids;
use QRFeedz\Cube\Models\Question;

class QuestionObserver
{
    use ConcernsGroupUuids;
    use ConcernsAutoIncrements;

    /**
     * Handle the Question "saving" event.
     */
    public function saving(Question $question): void
    {
        $this->resolveGroupedUuid($question);

        $this->resolveIncrement($question, 'questionnaire_id');

        /*
        if (! $question->group_uuid) {
            $question->group_uuid = (string) Str::uuid();
        }

        if (! $question->version) {
            $question->version = 1;
        }

        $lastVersion = Question::withTrashed()
                              ->where('group_uuid', $question->group_uuid)
                              ->where('id', '<>', $question->id)
                              ->orderBy('version', 'desc')
                              ->first();

        if ($lastVersion) {
            $question->version = $lastVersion->version + 1;
        }
        */
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
