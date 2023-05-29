<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use QRFeedz\Database\Factories\ClientFactory;

/**
 * A client is the main entity. It encompasses questionnaires, related users,
 * and affiliates. Questionnaires further branch out into various data
 * structures. Clients are invoiced based on the number of contracts
 * they have, typically for each active questionnaire per month.
 */
class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    /**
     * A client can be won via an affiliate. If so, qrfeedz will give a
     * commission to that affiliate per each payment that this client
     * will generate.
     *
     * Source: clients.affiliate_id
     * Relationship: validated
     */
    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

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
        return $this->morphToMany(Authorization::class, 'authorizable')
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

    // Relationship validated.
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'model', 'taggable')
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

    protected static function newFactory()
    {
        return ClientFactory::new();
    }
}
