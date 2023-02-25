<?php

namespace QRFeedz\Cube\Observers;

use Illuminate\Support\Str;
use QRFeedz\Cube\Models\Widget;

class WidgetObserver
{
    /**
     * Handle the Widget "saving" event.
     */
    public function saving(Widget $widget): void
    {
        if (! $widget->group_uuid) {
            $widget->group_uuid = (string) Str::uuid();
        }

        if (! $widget->version) {
            $widget->version = 1;
        }

        /**
         * If the id is already filled in, then we are updating the record.
         * So, we need to check if there are already other instances with
         * the same group_uuid, grab the last one, and increment the
         * version for this one.
         *
         * SQL Query: select * from widgets where group_uuid = xxx
         *                                  and id <> $this->id
         *                                  order by version desc.
         */
        $lastVersion = Widget::withTrashed()
                              ->where('group_uuid', $widget->group_uuid)
                              ->where('id', '<>', $widget->id)
                              ->orderBy('version', 'desc')
                              ->first();

        if ($lastVersion) {
            $widget->version = $lastVersion->version + 1;
        }
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
