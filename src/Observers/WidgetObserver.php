<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Widget;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class WidgetObserver extends QRFeedzObserver
{
    public function saving(Widget $model)
    {
        $this->validate($model, [
            'name' => 'required',
            'canonical' => 'required',
        ]);
    }

    public function deleting(Widget $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model).' cannot be deleted');
        }
    }

    public function forceDeleting(Widget $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model).' is not soft deleted first');
        }
    }
}
