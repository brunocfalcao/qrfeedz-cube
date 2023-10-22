<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\PageInstance;
use QRFeedz\Cube\Models\User;

/**
 * A page instance doesn't have much policy types, since it's created
 * after other model policies from its parents are already put in place.
 */
class PageInstancePolicy
{
    use NovaHelpers;

    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
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
        return $user->isSystemAdminLike();
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
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, PageInstance $model)
    {
        return false;
    }
}
