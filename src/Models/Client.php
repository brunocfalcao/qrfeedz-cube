<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
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
     * A client can be won via an affiliate. If so, qrfeedz will give a
     * commission to that affiliate per each payment that this client
     * will generate.
     *
     * Source: users.id
     * Relationship: validated
     */
    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class, 'id', 'user_affiliate_id');
    }

    /**
     * The default locale in case a message needs to be sent to the client,
     * an email or whatever.
     *
     * Source: locales.id
     * Relationship: validated
     */
    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }

    /**
     * A client address country relationship.
     *
     * Source: countries.id
     * Relationship: validated
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Related questionnaires. One client can have several questionaires.
     *
     * Source: questionnaires.id
     * Relationship: validated
     */
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }

    /**
     * A client can have several types of authorization per user that is
     * connected to it. The relationship between an user and a client is
     * given on the users.client_id, but the permission type is given
     * here.
     *
     * Source: authorizables.authorizable_type = 'Client' + authorizable_id
     * Relationship: verified.
     */
    public function authorizations()
    {
        return $this->morphToMany(Authorization::class, 'model')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    /**
     * Related categories that belong to this client. Each client own sees
     * its own categories that were created by its users.
     *
     * Source: categories.client_id
     * Relationship: validated
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Any tags that can belong to the client. The client tags are only used
     * by super admins to categorize/organize clients into specific tags
     * groups.
     *
     * Source: tags.id
     * Relationship: validated
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)
                    ->withTimestamps();
    }

    /**
     * Related users that belong to this client.
     *
     * Source: users.client_id
     * Relationship: validated
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
