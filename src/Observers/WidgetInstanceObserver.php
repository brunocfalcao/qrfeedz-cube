<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\WidgetInstance;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class WidgetInstanceObserver extends QRFeedzObserver
{
    public function saving(WidgetInstance $model)
    {
        $this->validate($model, [
            'question_instance_id' => 'required',
            'widget_id' => 'required',
        ]);
    }

    public function deleting(WidgetInstance $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model).' cannot be deleted');
        }
    }

    public function forceDeleting(WidgetInstance $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model).' is not soft deleted first');
        }
    }
}
