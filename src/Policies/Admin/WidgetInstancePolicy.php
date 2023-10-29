<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\User;
use QRFeedz\Cube\Models\WidgetInstance;

/**
 * Not much policies besides the default ones, since the major policies
 * are applied on parent eloquent models.
 */
class WidgetInstancePolicy
{
    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, WidgetInstance $model)
    {
        return $user->isAllowedAdminAccess();
    }

    public function create(User $user)
    {
        return
            // Not via a parent resource detail view.
            ! via_resource();
    }

    public function update(User $user, WidgetInstance $model)
    {
        return $user->isAllowedAdminAccess();
    }

    public function delete(User $user, WidgetInstance $model)
    {
        return
            // Model can be deleted.
            $model->canBeDeleted() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function restore(User $user, WidgetInstance $model)
    {
        return $model->trashed() && $user->isSuperAdmin();
    }

    public function forceDelete(User $user, WidgetInstance $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }
}
