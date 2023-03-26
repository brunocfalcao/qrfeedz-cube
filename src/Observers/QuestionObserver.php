<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Concerns\ConcernsAutoIncrements;
use QRFeedz\Cube\Models\Question;

class QuestionObserver
{
    use ConcernsAutoIncrements;

    public function saving(Question $model): void
    {
        //
    }
}
