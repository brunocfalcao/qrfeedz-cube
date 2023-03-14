<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Response;

class ResponseObserver
{
    /**
     * Handle the Response "saving" event.
     */
    public function saving(Response $model): void
    {
        //
    }

    /**
     * Handle the Response "created" event.
     */
    public function created(Response $model): void
    {
        //
    }

    /**
     * Handle the Response "updated" event.
     */
    public function updated(Response $model): void
    {
        //
    }

    /**
     * Handle the Response "deleted" event.
     */
    public function deleted(Response $model): void
    {
        //
    }

    /**
     * Handle the Response "restored" event.
     */
    public function restored(Response $model): void
    {
        //
    }

    /**
     * Handle the Response "force deleted" event.
     */
    public function forceDeleted(Response $model): void
    {
        //
    }
}
