<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelNovaHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\Location;
use QRFeedz\Cube\Models\User;

/**
 * Locations are created by admins, or by client admins.
 * Locations are only seen from users where that location is part of
 * on this case from the client locations list.
 */
class LocationPolicy
{
    use NovaHelpers;

    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
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
        return
            // Not via a parent resource detail view.
            ! via_resource() &&

            // User is an admin-kind user.
            $user->isAllowedAdminAccess();
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
        return $model->trashed() && $user->isSuperAdmin();
    }

    public function forceDelete(User $user, Location $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, Location $model)
    {
        // Replication is disabled.
        return false;
    }
}
