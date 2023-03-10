<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Tag;

class TagObserver
{
    /**
     * Handle the Tag "saving" event.
     */
    public function saving(Tag $model): void
    {
        //
    }

    /**
     * Handle the Tag "created" event.
     */
    public function created(Tag $model): void
    {
        //
    }

    /**
     * Handle the Tag "updated" event.
     */
    public function updated(Tag $model): void
    {
        //
    }

    /**
     * Handle the Tag "deleted" event.
     */
    public function deleted(Tag $model): void
    {
        //
    }

    /**
     * Handle the Tag "restored" event.
     */
    public function restored(Tag $model): void
    {
        //
    }

    /**
     * Handle the Tag "force deleted" event.
     */
    public function forceDeleted(Tag $model): void
    {
        //
    }
}
