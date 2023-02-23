<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Response;

class ResponseObserver
{
    /**
     * Handle the Response "saving" event.
     */
    public function saving(Response $response): void
    {
        //
    }

    /**
     * Handle the Response "created" event.
     */
    public function created(Response $response): void
    {
        //
    }

    /**
     * Handle the Response "updated" event.
     */
    public function updated(Response $response): void
    {
        //
    }

    /**
     * Handle the Response "deleted" event.
     */
    public function deleted(Response $response): void
    {
        //
    }

    /**
     * Handle the Response "restored" event.
     */
    public function restored(Response $response): void
    {
        //
    }

    /**
     * Handle the Response "force deleted" event.
     */
    public function forceDeleted(Response $response): void
    {
        //
    }
}
