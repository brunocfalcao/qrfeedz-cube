<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Database\Factories\GroupFactory;

class Group extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * A group can belong to a client. In case we want to group specific
     * information to a client.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * A client can have several questionnaires. Maybe most of the cases there
     * will be only one questionnaire, but it's possible to have several. As
     * example, an hotel that wants to have a questionnaire per room. On
     * this case we will need to group the questionnaires by hotel
     * subsidiary location.
     */
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }

    /**
     * The same as categories, applies also to tags. Normally this logic
     * is defined by the client itself when it understands the potential
     * of making reports out of this.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'model', 'taggable')
            ->withTimestamps();
    }

    /**
     * Not all the groups might have the same authorization per user. That's
     * where we refine that using the authorizations component for the group
     * itself. As example, a user might have READ access to a group without
     * being able to delete it.
     */
    public function authorizations()
    {
        return $this->morphToMany(Authorization::class, 'authorizable')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */
    public function authorizationsForUser(User $user)
    {
        return $this->morphToMany(Authorization::class, 'authorizable')
            ->withPivot('user_id')
            ->wherePivot('user_id', $user->id)
            ->withTimestamps();
    }

    /**
     * Special relationship that will return the authorizations for a logged
     * user. Used to simplify the query of getting what authorizations does
     * the logged user has respective to group authorizations.
     */
    public function loggedUserAuthorizations()
    {
        return $this->morphToMany(Authorization::class, 'authorizable')
            ->withPivot('user_id')
            ->wherePivot('user_id', Auth::id)
            ->withTimestamps();
    }

    protected static function newFactory()
    {
        return GroupFactory::new();
    }
}
