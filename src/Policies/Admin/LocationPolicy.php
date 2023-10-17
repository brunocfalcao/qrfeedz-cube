<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\Location;
use QRFeedz\Cube\Models\User;

class LocationPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Location $model)
    {
        return
            (
                // User is client admin.
                $user->isAuthorizedAs($model->client, 'client-admin') &&

                // The client is from the user itself.
                $model->client_id == $user->client_id
            ) ||
            (
                // User is affiliate.
                $user->isAffiliate() &&

                // And this is a location from one of his clients.
                $user->isAuthorizedAs($model->client, 'affiliate')
            ) ||

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function create(User $user)
    {
        // Don't create a location from a country detail.
        if (!via_resource('countries')) {
            return $user->isAllowedAdminAccess();
        }
    }

    public function update(User $user, Location $model)
    {
        return
            (
                // User is client admin.
                $user->isAuthorizedAs($model->client, 'client-admin') &&

                // The client is from the user itself.
                $model->client_id == $user->client_id
            ) ||
            (
                // User is affiliate.
                $user->isAffiliate() &&

                // And this is a location from one of his clients.
                $user->isAuthorizedAs($model->client, 'affiliate')
            ) ||

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function delete(User $user, Location $model)
    {
        return
            // The user is a super admin.
            $user->isSuperAdmin() &&

            // Model can be deleted.
            $model->canBeDeleted();
    }

    public function restore(User $user, Location $model)
    {
        // For now we can't execute this action. But we can update them.
        return false;
    }

    public function forceDelete(User $user, Location $model)
    {
        // For now we can't execute this action. But we can update them.
        return false;
    }

    public function replicate(User $user, Location $model)
    {
        // Replication is disabled.
        return false;
    }
}
