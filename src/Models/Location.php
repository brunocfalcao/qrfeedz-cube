<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Location extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * Source: clients.id
     * Relationship: validated
     * Relationship ID: 5
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Source: countries.id
     * Relationship: validated
     * Relationship ID: 25
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Source: questionnaires.id
     * Relationship: validated
     * Relationship ID: 26
     */
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }
}
