<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\Country;
use QRFeedz\Cube\Models\User;

/**
 * Countries can't be deleted or changed. Period.
 */
class CountryPolicy
{
    use NovaHelpers;

    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, Country $model)
    {
        return $user->isAllowedAdminAccess();
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Country $model)
    {
        return false;
    }

    public function delete(User $user, Country $model)
    {
        return
            // Model can be deleted.
            $model->canBeDeleted();
    }

    public function restore(User $user, Country $model)
    {
        // Only if it was trashed.
        return $model->trashed();
    }

    public function forceDelete(User $user, Country $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, Country $model)
    {
        // Replication is disabled.
        return false;
    }

    public function addClient(User $user, Country $country)
    {
        return false;
    }

    public function addUser(User $user, Country $country)
    {
        return false;
    }
}
