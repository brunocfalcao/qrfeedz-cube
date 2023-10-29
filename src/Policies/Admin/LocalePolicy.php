<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelNovaHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\Locale;
use QRFeedz\Cube\Models\User;

/**
 * The locales are used to add localization to client notifications,
 * questionnaire locales, widget and question instances. They are mostly
 * created once, for the questionnaire configuration and not changed for
 * that specific purpose.
 */
class LocalePolicy
{
    use NovaHelpers;

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
        return $model->trashed() && $user->isSuperAdmin();
    }

    public function forceDelete(User $user, Locale $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, Locale $model)
    {
        // Replication is disabled.
        return false;
    }
}
