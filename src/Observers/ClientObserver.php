<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Client;

class ClientObserver
{
    /**
     * Handle the Client "saving" event.
     */
    public function saving(Client $client): void
    {
        /**
         * - The "default_locale" can only be one of the locales columns.
         */
    }

    /**
     * Handle the Client "created" event.
     */
    public function created(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "updated" event.
     */
    public function updated(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "deleted" event.
     */
    public function deleted(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "restored" event.
     */
    public function restored(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "force deleted" event.
     */
    public function forceDeleted(Client $client): void
    {
        //
    }
}
