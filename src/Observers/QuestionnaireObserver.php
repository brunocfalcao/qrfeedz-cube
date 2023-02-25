<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Questionnaire;

class QuestionnaireObserver
{
    /**
     * Handle the Questionnaire "saving" event.
     */
    public function saving(Questionnaire $questionnaire): void
    {
        if (!$questionnaire->group_uuid) {
            $questionnaire->group_uuid = (string) Str::uuid();
        }

        if (!$questionnaire->version) {
            $questionnaire->version = 1;
        }

        /**
         * If the id is already filled in, then we are updating the record.
         * So, we need to check if there are already other instances with
         * the same group_uuid, grab the last one, and increment the
         * version for this one.
         *
         * SQL Query: select * from widgets where group_uuid = xxx
         *                                  and id <> $this->id
         *                                  order by version desc.
         */
        $lastVersion = Questionnaire::withTrashed()
                              ->where('group_uuid', $questionnaire->group_uuid)
                              ->where('id', '<>', $questionnaire->id)
                              ->orderBy('version', 'desc')
                              ->first();

        if ($lastVersion) {
            $questionnaire->version = $lastVersion->version + 1;
        }
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
