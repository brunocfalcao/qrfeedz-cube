<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\Authorization;
use QRFeedz\Cube\Models\User;

class AuthorizationPolicy
{
    public function viewAny(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, Authorization $model)
    {
        return $user->isAllowedAdminAccess();
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
        return $user->isSuperAdmin();
    }

    public function restore(User $user, Authorization $model)
    {
        return $user->isSuperAdmin();
    }

    public function forceDelete(User $user, Authorization $model)
    {
        return $user->isSuperAdmin();
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
