<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Authorization;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class AuthorizationObserver extends QRFeedzObserver
{
    public function creating(Authorization $model)
    {
        $this->validate($model, [
            'name' => 'required',
            'canonical' => 'unique:authorizations',
            'description' => 'required',
        ]);
    }

    public function updating(Authorization $model)
    {
        $this->validate($model, [
            'name' => 'required',
            'canonical' => 'unique:authorizations,canonical,'.$model->id,
            'description' => 'required',
        ]);
    }

    public function deleting(Authorization $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model) . ' cannot be deleted');
        }
    }

    public function forceDeleting(Authorization $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model) . ' is not soft deleted first');
        }
    }
}
