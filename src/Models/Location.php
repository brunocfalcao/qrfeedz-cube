<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Cube\Concerns\HasAuthorizations;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Location extends QRFeedzModel
{
    use HasAuthorizations, SoftDeletes;

    /**
     * The related client.
     *
     * Source: clients.id
     * Relationship: validated
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * The related country.
     *
     * Source: countries.id
     * Relationship: validated
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * The related questionnaires.
     *
     * Source: questionnaires.id
     * Relationship: validated
     */
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }
}
