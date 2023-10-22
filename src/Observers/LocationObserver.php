<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Location;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;

class LocationObserver extends QRFeedzObserver
{
    public function creating(Location $model)
    {
        $this->validate($model, [
            'name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'country_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
    }

    public function updating(Location $model)
    {
        $this->validate($model, [
            'name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'country_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
    }

    public function deleting(Location $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model) . ' cannot be deleted');
        }
    }

    public function forceDeleting(Location $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model) . ' is not soft deleted first');
        }
    }
}
