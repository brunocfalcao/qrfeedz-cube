<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelNovaHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\Page;
use QRFeedz\Cube\Models\User;

class PagePolicy
{
    use NovaHelpers;

    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, Page $model)
    {
        return $user->isAllowedAdminAccess();
    }

    public function create(User $user)
    {
        return
            // Not via a parent resource detail view.
            ! via_resource() &&

            // User is a super admin.
            $user->isSuperAdmin();
    }

    public function update(User $user, Page $model)
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, Page $model)
    {
        return
            // Model can be deleted.
            $model->canBeDeleted() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function restore(User $user, Page $model)
    {
        return false;
    }

    public function forceDelete(User $user, Page $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, Page $model)
    {
        // Replication is disabled.
        return false;
    }
}
