<?php

namespace QRFeedz\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Rules\MaxUploadSize;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Notifications\NovaNotification;
use QRFeedz\Cube\Models\Client;
use QRFeedz\Cube\Models\Location;
use QRFeedz\Foundation\Abstracts\QRFeedzObserver;
use QRFeedz\Services\Facades\QRFeedz;

class ClientObserver extends QRFeedzObserver
{
    public function creating(Client $model)
    {
        $this->validate($model, [
            'name' => 'required',
            'address' => 'required',
            'country_id' => 'required',
            //'logo_file' => ['image|', new MaxUploadSize()],
        ]);
    }

    public function updating(Client $model)
    {
        $this->validate($model, [
            'name' => 'required',
            'address' => 'required',
            'country_id' => 'required',
            'logo_file' => [new MaxUploadSize()],
        ]);
    }

    public function deleting(Client $model)
    {
        if (! $model->canBeDeleted()) {
            throw new \Exception(class_basename($model).' model cannot be deleted');
        }
    }

    public function forceDeleting(Client $model)
    {
        if (! $model->trashed()) {
            throw new \Exception(class_basename($model).' model is not soft deleted first');
        }
    }

    public function created(Client $model)
    {
        /**
         * When we create a new client, we create a location with the exact
         * same location coordinates. Then it can attach questionnaires to
         * this default location.
         */
        Location::create([
            'name' => $model->name,
            'client_id' => $model->id,
            'address' => $model->address,
            'postal_code' => $model->postal_code,
            'city' => $model->city,
            'latitude' => $model->latitude,
            'longitude' => $model->longitude,
            'country_id' => $model->country_id,
        ]);

        if (Auth::user() && QRFeedz::inAdmin()) {
            Auth::user()->notify(
                NovaNotification::make()
                ->message('A default location was created for the client '.$model->name)
                ->type('info')
            );
        }
    }
}
