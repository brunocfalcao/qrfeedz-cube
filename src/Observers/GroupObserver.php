<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Group;

class GroupObserver
{
    /**
     * Handle the Group "saving" event.
     */
    public function saving(Group $model): void
    {
        //
    }

    /**
     * Handle the Group "created" event.
     */
    public function created(Group $model): void
    {
        //
    }

    /**
     * Handle the Group "updated" event.
     */
    public function updated(Group $model): void
    {
        //
    }

    /**
     * Handle the Group "deleted" event.
     */
    public function deleted(Group $model): void
    {
        //
    }

    /**
     * Handle the Group "restored" event.
     */
    public function restored(Group $model): void
    {
        //
    }

    /**
     * Handle the Group "force deleted" event.
     */
    public function forceDeleted(Group $model): void
    {
        //
    }
}
