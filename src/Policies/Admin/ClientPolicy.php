<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\Client;
use QRFeedz\Cube\Models\User;

class ClientPolicy
{
    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, Client $model)
    {
        return
            // The user is affiliate for this client instance.
            $user->isAffiliateOf($model) ||

            // The user is a super admin.
            $user->isSuperAdmin() || (

                // The logged user belongs to the client instance.
                $model->id == $user->client_id &&

                // The logged user is allowed admin access.
                $user->isAllowedAdminAccess()
            );
    }

    public function create(User $user)
    {
        return
            // The user is an affiliate.
            $user->isAffiliate() ||

            // The user is a super admin.
            $user->isSuperAdmin();
    }

    public function update(User $user, Client $model)
    {
        return
            // The user has an "affiliate" authorization on the client instance.
            $user->isAffiliateOf($model) ||

            // The user is a super admin.
            $user->isSuperAdmin() || (

                // The logged user belongs to the client instance.
                $model->id == $user->client_id &&

                // The logged user is "admin" on the client instance.
                $user->isAuthorizedAs($model, 'client-admin')
            );
    }

    public function delete(User $user, Client $model)
    {
        return
            // The user is a super admin.
            $user->isSuperAdmin() &&

            // Model can be deleted.
            $model->canBeDeleted();
    }

    public function restore(User $user, Client $model)
    {
        // Only if it was trashed.
        return $model->trashed();
    }

    public function forceDelete(User $user, Client $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, Client $model)
    {
        return false;
    }

    public function attachAnyAuthorization(User $user, Client $client)
    {
        return false;
    }
}
