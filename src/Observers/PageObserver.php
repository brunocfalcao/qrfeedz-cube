<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Page;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class PageObserver extends QRFeedzObserver
{
    public function saving(Page $model)
    {
        $this->validate($model, [
            'name' => 'required',
            'canonical' => 'required',
            'description' => 'required',
            'view_component_namespace' => 'required',
        ]);
    }

    public function deleting(Page $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model).' cannot be deleted');
        }
    }

    public function forceDeleting(Page $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model).' not soft deleted first');
        }
    }
}
