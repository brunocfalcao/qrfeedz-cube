<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Country;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class CountryObserver extends QRFeedzObserver
{
    public function saving(Country $model)
    {
        //
    }

    public function deleting(Country $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model).' model cannot be deleted');
        }
    }

    public function forceDeleting(Country $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model).' is not soft deleted first');
        }
    }
}
