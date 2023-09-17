<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\Authorization;
use QRFeedz\Cube\Models\User;

/**
 * All authorizations in admin/backend are only managed by the super admin.
 * In any other place an Authorization model can be seen.
 */
class AuthorizationPolicy
{
    public function viewAny(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, Authorization $model)
    {
        return $user->isSuperAdmin();
    }

    public function create(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function update(User $user, Authorization $model)
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, Authorization $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(User $user, Authorization $model)
    {
        return $user->isSuperAdmin();
    }

    public function forceDelete(User $user, Authorization $model)
    {
        return $model->canBeDeleted();
    }

    public function replicate(User $user, Authorization $model)
    {
        return false;
    }

    public function attachAnyClient(User $user, Authorization $model)
    {
        return false;
    }
}
