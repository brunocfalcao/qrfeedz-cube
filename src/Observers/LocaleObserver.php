<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Locale;

class LocaleObserver
{
    /**
     * Handle the Locale "saving" event.
     */
    public function saving(Locale $locale): void
    {
        //
    }

    /**
     * Handle the Locale "created" event.
     */
    public function created(Locale $locale): void
    {
        //
    }

    /**
     * Handle the Locale "updated" event.
     */
    public function updated(Locale $locale): void
    {
        //
    }

    /**
     * Handle the Locale "deleted" event.
     */
    public function deleted(Locale $locale): void
    {
        //
    }

    /**
     * Handle the Locale "restored" event.
     */
    public function restored(Locale $locale): void
    {
        //
    }

    /**
     * Handle the Locale "force deleted" event.
     */
    public function forceDeleted(Locale $locale): void
    {
        //
    }
}
