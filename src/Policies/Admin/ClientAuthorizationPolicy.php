<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelNovaHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\ClientAuthorization;
use QRFeedz\Cube\Models\User;

/**
 * Countries can't be deleted or changed. Period.
 */
class ClientAuthorizationPolicy
{
    use NovaHelpers;

    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, ClientAuthorization $model)
    {
        return $user->isAllowedAdminAccess();
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, ClientAuthorization $model)
    {
        return true;
    }

    public function delete(User $user, ClientAuthorization $model)
    {
        return
            // Model can be deleted.
            $model->canBeDeleted() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function restore(User $user, ClientAuthorization $model)
    {
        // Only if it was trashed.
        return $model->trashed();
    }

    public function forceDelete(User $user, ClientAuthorization $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, ClientAuthorization $model)
    {
        // Replication is disabled.
        return false;
    }
}
