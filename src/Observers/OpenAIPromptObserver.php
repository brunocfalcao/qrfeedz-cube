<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Concerns\ConcernsAutoIncrements;
use QRFeedz\Cube\Models\OpenAIPrompt;

class OpenAIPromptObserver
{
    use ConcernsAutoIncrements;

    /**
     * Handle the OpenAIPrompt "saving" event.
     */
    public function saving(OpenAIPrompt $model): void
    {
        //
    }

    /**
     * Handle the OpenAIPrompt "created" event.
     */
    public function created(OpenAIPrompt $model): void
    {
        //
    }

    /**
     * Handle the OpenAIPrompt "updated" event.
     */
    public function updated(OpenAIPrompt $model): void
    {
        //
    }

    /**
     * Handle the OpenAIPrompt "deleted" event.
     */
    public function deleted(OpenAIPrompt $model): void
    {
        //
    }

    /**
     * Handle the OpenAIPrompt "restored" event.
     */
    public function restored(OpenAIPrompt $model): void
    {
        //
    }

    /**
     * Handle the OpenAIPrompt "force deleted" event.
     */
    public function forceDeleted(OpenAIPrompt $model): void
    {
        //
    }
}
