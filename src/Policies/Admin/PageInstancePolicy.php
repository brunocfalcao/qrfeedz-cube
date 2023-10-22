<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\PageInstance;
use QRFeedz\Cube\Models\User;

class PageInstancePolicy
{
    public function viewAny(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, PageInstance $model)
    {
        return $user->isAllowedAdminAccess();
    }

    public function create(User $user)
    {
        return
            // Not via a parent resource detail view.
            ! via_resource() &&

            // User is a system admin like.
            $user->isSystemAdminLike();
    }

    public function update(User $user, PageInstance $model)
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, PageInstance $model)
    {
        return
            // Model can be deleted.
            $model->canBeDeleted() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function restore(User $user, PageInstance $model)
    {
        return false;
    }

    public function forceDelete(User $user, PageInstance $model)
    {
        return false;
    }

    public function replicate(User $user, PageInstance $model)
    {
        return false;
    }
}
