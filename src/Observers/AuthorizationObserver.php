<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Authorization;

class AuthorizationObserver
{
    /**
     * Handle the Authorization "saving" event.
     */
    public function saving(Authorization $model): void
    {
        //
    }

    /**
     * Handle the Authorization "created" event.
     */
    public function created(Authorization $model): void
    {
        //
    }

    /**
     * Handle the Authorization "updated" event.
     */
    public function updated(Authorization $model): void
    {
        //
    }

    /**
     * Handle the Authorization "deleted" event.
     */
    public function deleted(Authorization $model): void
    {
        //
    }

    /**
     * Handle the Authorization "restored" event.
     */
    public function restored(Authorization $model): void
    {
        //
    }

    /**
     * Handle the Authorization "force deleted" event.
     */
    public function forceDeleted(Authorization $model): void
    {
        //
    }
}
