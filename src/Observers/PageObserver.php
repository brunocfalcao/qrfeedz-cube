<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Page;

class PageObserver
{
    /**
     * Handle the Page "saving" event.
     */
    public function saving(Page $model): void
    {
        //
    }

    /**
     * Handle the Page "created" event.
     */
    public function created(Page $model): void
    {
        //
    }

    /**
     * Handle the Page "updated" event.
     */
    public function updated(Page $model): void
    {
        //
    }

    /**
     * Handle the Page "deleted" event.
     */
    public function deleted(Page $model): void
    {
        //
    }

    /**
     * Handle the Page "restored" event.
     */
    public function restored(Page $model): void
    {
        //
    }

    /**
     * Handle the Page "force deleted" event.
     */
    public function forceDeleted(Page $model): void
    {
        //
    }
}
