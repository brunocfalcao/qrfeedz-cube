<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\Client;
use QRFeedz\Cube\Models\User;

class ClientPolicy
{
    public function viewAny(User $user)
    {
        // Anyone registered can view user resources.
        return true;
    }

    public function view(User $user, Client $model)
    {
        return
            // The user has an "affiliate" authorization on the client instance.
            $user->isAffiliateOf($model) ||

            // The user is a super admin.
            $user->isSuperAdmin() || (

                // The logged user belongs to the client instance.
                $model->id == $user->client_id &&

                // The logged user is "client-admin" on the client instance.
                $user->isAuthorizedAs($model, 'client-admin')
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
        // We cannot force delete clients, no matter what scenario it is.
        return false;
    }

    public function replicate(User $user, Client $model)
    {
        // Replication is disabled for clients.
        return false;
    }
}
