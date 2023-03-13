<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questionnaire extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    // Relationship validated.
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relationship validated.
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    // Relationship validated.
    public function authorizations()
    {
        return $this->morphToMany(Authorization::class, 'authorizable')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    // Relationship validated.
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
     * the logged user has respective to questionnaire authorizations.
     */
    public function loggedUserAuthorizations()
    {
        return $this->morphToMany(Authorization::class, 'authorizable')
                    ->withPivot('user_id')
                    ->wherePivot('user_id', Auth::id)
                    ->withTimestamps();
    }

    // Relationship validated.
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Relationship validated.
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable')
                    ->withTimestamps();
    }

    // Relationship validated.
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')
                    ->withTimestamps();
    }

    /**
     * In case there is no default locale specified, we pick the one
     * from the client, or fallback to en.
     */
    public function defaultDefaultLocaleAttribute()
    {
        return $this->client->default_locale ?? 'en';
    }
}
