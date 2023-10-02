<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\OpenAIPrompt;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class OpenAIPromptObserver extends QRFeedzObserver
{
    public function saving(OpenAIPrompt $model)
    {
        //
    }
}
