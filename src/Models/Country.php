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
     * Related affiliates country.
     *
     * Source: affiliates.country_id
     * Relationship: validated
     */
    public function affiliates()
    {
        return $this->hasMany(Affiliate::class);
    }
}
