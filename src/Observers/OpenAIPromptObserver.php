<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\OpenAIPrompt;

class OpenAIPromptObserver
{
    /**
     * Handle the OpenAIPrompt "saving" event.
     */
    public function saving(OpenAIPrompt $model)
    {
        //
    }

    /**
     * Handle the OpenAIPrompt "created" event.
     */
    public function created(OpenAIPrompt $model)
    {
        //
    }

    /**
     * Handle the OpenAIPrompt "updated" event.
     */
    public function updated(OpenAIPrompt $model)
    {
        //
    }

    /**
     * Handle the OpenAIPrompt "deleted" event.
     */
    public function deleted(OpenAIPrompt $model)
    {
        //
    }

    /**
     * Handle the OpenAIPrompt "restored" event.
     */
    public function restored(OpenAIPrompt $model)
    {
        //
    }

    /**
     * Handle the OpenAIPrompt "force deleted" event.
     */
    public function forceDeleted(OpenAIPrompt $model)
    {
        //
    }
}
