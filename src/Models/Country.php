<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Country extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * Related client country from its address.
     *
     * Source: clients.country_id
     * Relationship: validated
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * Related client country from its address.
     *
     * Source: users.country_id
     * Relationship: validated
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * The related locations.
     *
     * Source: location.id
     * Relationship: validated
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
