<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Country extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * Source: clients.country_id
     * Relationship: validated
     * Relationship ID: 9
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * Source: users.country_id
     * Relationship: validated
     * Relationship ID: 3
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Source: location.id
     * Relationship: validated
     * Relationship ID: 25
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function canBeDeleted()
    {
        // We cannot delete countries.
        return false;
    }
}
