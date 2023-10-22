<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\Locale;
use QRFeedz\Cube\Models\User;

class LocalePolicy
{
    public function viewAny(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, Locale $model)
    {
        return
            // Belongs to permissions to access admin.
            $user->isAllowedAdminAccess();
    }

    public function create(User $user)
    {
        return
            // Not via a parent resource detail view.
            ! via_resource() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function update(User $user, Locale $model)
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, Locale $model)
    {
        return
            // Model can be deleted.
            $model->canBeDeleted() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function restore(User $user, Locale $model)
    {
        return false;
    }

    public function forceDelete(User $user, Locale $model)
    {
        return false;
    }

    public function replicate(User $user, Locale $model)
    {
        // Replication is disabled.
        return false;
    }
}
