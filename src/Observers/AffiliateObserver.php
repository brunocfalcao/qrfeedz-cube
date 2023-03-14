<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Affiliate;

class AffiliateObserver
{
    /**
     * Handle the Affiliate "saving" event.
     */
    public function saving(Affiliate $model): void
    {
        //
    }

    /**
     * Handle the Affiliate "created" event.
     */
    public function created(Affiliate $model): void
    {
        //
    }

    /**
     * Handle the Affiliate "updated" event.
     */
    public function updated(Affiliate $model): void
    {
        //
    }

    /**
     * Handle the Affiliate "deleted" event.
     */
    public function deleted(Affiliate $model): void
    {
        //
    }

    /**
     * Handle the Affiliate "restored" event.
     */
    public function restored(Affiliate $model): void
    {
        //
    }

    /**
     * Handle the Affiliate "force deleted" event.
     */
    public function forceDeleted(Affiliate $model): void
    {
        //
    }
}
