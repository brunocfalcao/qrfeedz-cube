<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * An affiliate is a person who can earn a commission based on the number of
 * clients they refer. Each affiliate can have multiple clients, and the
 * payment from each client is divided between qrfeedz and the
 * affiliate.
 */
class Affiliate extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'commission_percentage' => 'integer',
    ];

    /**
     * The related user model. An affiliate is always connected to its own
     * user, corresponding to a person that will receive a comission.
     *
     * Source: users.affiliate_id
     * Relationship: validated
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Each affiliate has a relationship with many clients, as many as the
     * affiliate can sell the qrfeedz to them and receive a commission.
     *
     * Source: clients.affiliate_id
     * Relationship: validated
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * The related country from the affiliate address.
     *
     * Source: affiliates.country_id
     * Relationship: validated
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
