<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class ClientAuthorization extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * Source: clients.id
     * Relationship:
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Source: users.id
     * Relationship:
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Source: authorizations.id
     * Relationship:
     */
    public function authorization()
    {
        return $this->belongsTo(Authorization::class);
    }
}
