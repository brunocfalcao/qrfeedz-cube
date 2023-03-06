<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Concerns\ConcernsGroupUuids;
use QRFeedz\Cube\Models\Widget;

class WidgetObserver
{
    use ConcernsGroupUuids;

    /**
     * Handle the Widget "saving" event.
     */
    public function saving(Widget $widget): void
    {
        $this->resolveGroupedUuid($widget);
    }

    /**
     * Handle the Widget "created" event.
     */
    public function created(Widget $widget): void
    {
        //
    }

    /**
     * Handle the Widget "updated" event.
     */
    public function updated(Widget $widget): void
    {
        //
    }

    /**
     * Handle the Widget "deleted" event.
     */
    public function deleted(Widget $widget): void
    {
        //
    }

    /**
     * Handle the Widget "restored" event.
     */
    public function restored(Widget $widget): void
    {
        //
    }

    /**
     * Handle the Widget "force deleted" event.
     */
    public function forceDeleted(Widget $widget): void
    {
        //
    }
}
