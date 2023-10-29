<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\User;
use QRFeedz\Cube\Models\Widget;

/**
 * No specific policies, since there are parent policies at the questionnaire
 * level, and widgets can't be managed by anyone except admins.
 */
class WidgetPolicy
{
    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, Widget $model)
    {
        return $user->isAllowedAdminAccess();
    }

    public function create(User $user)
    {
        return
            // Not via a parent resource detail view.
            ! via_resource();
    }

    public function update(User $user, Widget $model)
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, Widget $model)
    {
        return
            // Model can be deleted.
            $model->canBeDeleted() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function restore(User $user, Widget $model)
    {
        return $model->trashed() && $user->isSuperAdmin();
    }

    public function forceDelete(User $user, Widget $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }
}
