<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\Page;
use QRFeedz\Cube\Models\User;

class PagePolicy
{
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
        return $user->isSuperAdmin();
    }

    public function update(User $user, Page $model)
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, Page $model)
    {
        return $user->isSuperAdmin();
    }

    public function restore(User $user, Page $model)
    {
        return false;
    }

    public function forceDelete(User $user, Page $model)
    {
        return false;
    }

    public function replicate(User $user, Page $model)
    {
        // Replication is disabled.
        return false;
    }
}
