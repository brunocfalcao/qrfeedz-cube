<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class ClientAuthorization extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * Source: clients.id
     * Relationship: validated
     * Relationship ID: 34
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Source: users.id
     * Relationship: validated
     * Relationship ID: 33
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Source: authorizations.id
     * Relationship: validated
     * Relationship ID: 4
     */
    public function authorization()
    {
        return $this->belongsTo(Authorization::class);
    }

    public function canBeDeleted()
    {
        // Nothing specific to compute, at the moment.
        return true;
    }
}
