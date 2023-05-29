<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $guarded = [];

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
