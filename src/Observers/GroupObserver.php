<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Group;

class GroupObserver
{
    /**
     * Handle the Group "saving" event.
     */
    public function saving(Group $group): void
    {
        //
    }

    /**
     * Handle the Group "created" event.
     */
    public function created(Group $group): void
    {
        //
    }

    /**
     * Handle the Group "updated" event.
     */
    public function updated(Group $group): void
    {
        //
    }

    /**
     * Handle the Group "deleted" event.
     */
    public function deleted(Group $group): void
    {
        //
    }

    /**
     * Handle the Group "restored" event.
     */
    public function restored(Group $group): void
    {
        //
    }

    /**
     * Handle the Group "force deleted" event.
     */
    public function forceDeleted(Group $group): void
    {
        //
    }
}
