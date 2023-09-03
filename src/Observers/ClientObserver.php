<?php

namespace QRFeedz\Cube\Observers;

use QRFeedz\Cube\Models\Client;
use QRFeedz\Cube\Models\Location;

class ClientObserver
{
    public function saving(Client $model)
    {
        //
    }

    public function created(Client $model)
    {
        /**
         * When we create a new client, we replicate it to a location.
         */
        Location::create([
            'name' => $model->name,
            'client_id' => $model->id,
            'address' => $model->address,
            'postal_code' => $model->postal_code,
            'locality' => $model->locality,
            'country_id' => $model->country_id,
        ]);
    }
}
