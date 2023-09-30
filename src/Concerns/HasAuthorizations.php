<?php

namespace QRFeedz\Cube\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use QRFeedz\Cube\Models\Authorization;
use QRFeedz\Cube\Models\AuthorizationUser;
use QRFeedz\Cube\Models\User;

trait HasAuthorizations
{
    /**
     * Returns the authorizations that are part of the user that is passed
     * as the parameter. On this case returns the morphable authorizations
     * for this user (from clients, questionnaires, locations, etc).
     */
    public function authorizationsForUser(User $user, Model $model = null)
    {
        return $this->morphToMany(
            Authorization::class,
            'model',
            'authorizables'
        )
            ->withPivot('user_id')
            ->wherePivot('user_id', $user->id)
            ->when($model !== null, function ($query) use ($model) {
                return $query->where('model_type', (string) $model);
            })
            ->withTimestamps();
    }

    /**
     * Returns all authorizations for the respective model instance.
     *
     * Source: authorizables.authorizable_type = <model> + authorizable_id
     * Relationship: verified.
     */
    public function authorizations()
    {
        return $this->morphToMany(
            Authorization::class,
            'model',
            'authorizables'
        )
            //->withPivot('user_id')
            ->using(AuthorizationUser::class)
            ->withTimestamps();
    }

    /**
     * Special relationship that will return the authorizations for a logged
     * user. Used to simplify the query of getting what authorizations does
     * the logged user has respective to questionnaire authorizations.
     */
    public function loggedUserAuthorizations()
    {
        return $this->authorizationsForUser(Auth::user());
    }
}
