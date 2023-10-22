<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\User;
use QRFeedz\Cube\Models\WidgetInstance;

class WidgetInstancePolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, WidgetInstance $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return
            // Not via a parent resource detail view.
            ! via_resource();
    }

    public function update(User $user, WidgetInstance $model)
    {
        return true;
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
        return true;
    }

    public function forceDelete(User $user, WidgetInstance $model)
    {
        return true;
    }
}
