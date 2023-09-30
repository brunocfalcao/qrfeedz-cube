<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Category;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class CategoryObserver extends QRFeedzObserver
{
    public function creating(Category $model)
    {
        $this->validate($model, [
            'name' => 'required',
            'canonical' => 'unique:authorizations',
            'description' => 'required',
        ]);
    }

    public function updating(Category $model)
    {
        $this->validate($model, [
            'name' => 'required',
            'canonical' => 'unique:authorizations,canonical,'.$model->id,
            'description' => 'required',
        ]);
    }

    public function deleting(Category $model)
    {
        return true;

        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model).' model cannot be deleted');
        }
    }

    public function forceDeleting(Category $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model).'  model is not soft deleted first');
        }
    }
}
