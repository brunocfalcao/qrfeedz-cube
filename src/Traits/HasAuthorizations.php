<?php

namespace QRFeedz\Cube\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use QRFeedz\Cube\Models\Authorization;
use QRFeedz\Cube\Models\User;

trait HasAuthorizations
{
    /**
     * This special query will return if an user has at least a single
     * entry in the authorizables table with a specific authorization
     * type.
     *
     * @param  string  $type Authorization canonical
     * @return bool
     */
    public function isAtLeastAuthorizedAs(string $type)
    {
        // Needs to be obtained via a direct query.
        return DB::table('authorizables')
                 ->where('user_id', $this->id)
                 ->where('authorization_id', Authorization::firstWhere('canonical', $type)->id)
                 ->whereNull('deleted_at')
                 ->count() > 0;
    }

    /**
     * Returns the authorizations that are part of the user that is passed
     * as the parameter.
     */
    public function authorizationsForUser(User $user)
    {
        return $this->morphToMany(
            Authorization::class,
            'model',
            'authorizables'
        )
            ->withPivot('user_id')
            ->wherePivot('user_id', $user->id)
            ->withTimestamps();
    }

    /**
     * A client can have several types of authorization per user that is
     * connected to it. The relationship between an user and a client is
     * given on the users.client_id, but the permission type is given
     * here.
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
            ->withPivot('user_id')
            ->withTimestamps();
    }
}
