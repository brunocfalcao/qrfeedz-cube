<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\PageInstance;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class PageInstanceObserver extends QRFeedzObserver
{
    public function saving(PageInstance $model)
    {
        $this->validate($model, [
            'uuid' => 'required',
            'name' => 'required',
            'page_id' => 'required',
        ]);
    }

    public function deleting(PageInstance $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model).' cannot be deleted');
        }
    }

    public function forceDeleting(PageInstance $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model).' is not soft deleted first');
        }
    }
}
