<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Category;

class CategoryObserver
{
    /**
     * Handle the Category "saving" event.
     */
    public function saving(Category $model): void
    {
        //
    }

    /**
     * Handle the Category "created" event.
     */
    public function created(Category $model): void
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $model): void
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $model): void
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $model): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $model): void
    {
        //
    }
}
