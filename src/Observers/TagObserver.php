<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Tag;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class TagObserver extends QRFeedzObserver
{
    public function saving(Tag $model)
    {
        $this->validate($model, [
            'questionnaire_id' => 'required',
            'name' => 'required',
        ]);
    }

    public function deleting(Tag $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model).' cannot be deleted');
        }
    }

    public function forceDeleting(Tag $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model).' is not soft deleted first');
        }
    }
}
