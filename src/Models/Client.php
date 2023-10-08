<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

/**
 * A client is the main entity. It encompasses questionnaires, related users,
 * and affiliates. Questionnaires further branch out into various data
 * structures. Clients are invoiced based on the number of contracts
 * they have, typically for each active questionnaire per month.
 */
class Client extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * Source: users.id
     * Relationship: validated
     * Relationship ID: 1
     */
    public function affiliate()
    {
        return $this->belongsTo(User::class, 'user_affiliate_id');
    }

    /**
     * Source: locales.id
     * Relationship: validated
     * Relationship ID: 11
     */
    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }

    /**
     * Source: questionnaires.id
     * Relationship: validated
     * Relationship ID: 30
     */
    public function questionnaires()
    {
        return $this->hasManyThrough(Questionnaire::class, Location::class);
    }

    /**
     * Source: countries.id
     * Relationship: validated
     * Relationship ID: 9
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Source: locations.id
     * Relationship: validated
     * Relationship ID: 5
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    /**
     * Source: users.client_id
     * Relationship: validated
     * Relationship ID: 7
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Source: client_authorizations.client_id
     * Relationship: validated
     * Relationship ID: 34
     */
    public function authorizations()
    {
        return $this->hasMany(ClientAuthorization::class);
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */

    /**
     * Decides if an eloquent model can be deleted, so all the conditions need
     * to meet before the instance is deleted. Can be used for force delete too.
     */
    public function canBeDeleted()
    {
        /**
         * A client can be deleted if:
         * - All locations are force deleted.
         * - All users are force deleted.
         */
        return
            DB::table('locations')
              ->where('client_id', $this->id)
              ->count() == 0 &&

            DB::table('users')
              ->where('client_id', $this->id)
              ->count() == 0;
    }
}
