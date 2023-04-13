<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use QRFeedz\Database\Factories\ClientFactory;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    // Relationship validated.
    public function affiliate()
    {
        return $this->hasOne(Affiliate::class);
    }

    // Relationship validated.
    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }

    // Eloquent relationship validated.
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Relationship validated.
    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    // Relationship validated.
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }

    // Relationship validated.
    public function authorizations()
    {
        return $this->morphToMany(Authorization::class, 'authorizables')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    // Relationship validated.
    public function authorizationsForUser(User $user)
    {
        return $this->morphToMany(Authorization::class, 'authorizables')
                    ->withPivot('user_id')
                    ->wherePivot('user_id', $user->id)
                    ->withTimestamps();
    }

    /**
     * Special relationship that will return the authorizations for a logged
     * user. Used to simplify the query of getting what authorizations does
     * the logged user has respective to client authorizations.
     */
    public function loggedUserAuthorizations()
    {
        return $this->morphToMany(Authorization::class, 'authorizables')
                    ->withPivot('user_id')
                    ->wherePivot('user_id', Auth::id)
                    ->withTimestamps();
    }

    // Relationship validated.
    public function categories()
    {
        return $this->morphToMany(Category::class, 'model', 'categorizables')
                    ->withTimestamps();
    }

    // Relationship validated.
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'model', 'taggables')
                    ->withTimestamps();
    }

    // Relationship validated.
    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected static function newFactory()
    {
        return ClientFactory::new();
    }
}
