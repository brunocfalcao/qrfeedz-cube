<?php

namespace QRFeedz\Cube\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
    }

    /**
     * Returns all authorizations for the respective model instance.
     *
     * Source: authorizables.authorizable_type = <model> + authorizable_id
     * Relationship: verified.
     */
    public function authorizations()
    {
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
