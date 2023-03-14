<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Country;

class CountryObserver
{
    /**
     * Handle the Country "saving" event.
     */
    public function saving(Country $model): void
    {
        //
    }

    /**
     * Handle the Country "created" event.
     */
    public function created(Country $model): void
    {
        //
    }

    /**
     * Handle the Country "updated" event.
     */
    public function updated(Country $model): void
    {
        //
    }

    /**
     * Handle the Country "deleted" event.
     */
    public function deleted(Country $model): void
    {
        //
    }

    /**
     * Handle the Country "restored" event.
     */
    public function restored(Country $model): void
    {
        //
    }

    /**
     * Handle the Country "force deleted" event.
     */
    public function forceDeleted(Country $model): void
    {
        //
    }
}
