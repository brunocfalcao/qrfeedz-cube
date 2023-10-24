<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Response;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class ResponseObserver extends QRFeedzObserver
{
    public function saving(Response $model)
    {
        $this->validate($model, [
            'session_instance_id' => 'required',
            'question_instance_id' => 'required',
            'widget_instance_id' => 'required',
        ]);
    }

    public function deleting(Response $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model).' cannot be deleted');
        }
    }

    public function forceDeleting(Response $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model).' is not soft deleted first');
        }
    }
}
