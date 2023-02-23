<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Organization;

class OrganizationObserver
{
    /**
     * Handle the Organization "saving" event.
     */
    public function saving(Organization $organization): void
    {
        //
    }

    /**
     * Handle the Organization "created" event.
     */
    public function created(Organization $organization): void
    {
        //
    }

    /**
     * Handle the Organization "updated" event.
     */
    public function updated(Organization $organization): void
    {
        //
    }

    /**
     * Handle the Organization "deleted" event.
     */
    public function deleted(Organization $organization): void
    {
        //
    }

    /**
     * Handle the Organization "restored" event.
     */
    public function restored(Organization $organization): void
    {
        //
    }

    /**
     * Handle the Organization "force deleted" event.
     */
    public function forceDeleted(Organization $organization): void
    {
        //
    }
}
