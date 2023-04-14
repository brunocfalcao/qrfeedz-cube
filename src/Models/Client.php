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

    public function affiliate()
    {
        return $this->hasOne(Affiliate::class);
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

    public function authorizations()
    {
        return $this->morphToMany(Authorization::class, 'authorizables')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

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
