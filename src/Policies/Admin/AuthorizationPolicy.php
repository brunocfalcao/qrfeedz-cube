<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\Authorization;
use QRFeedz\Cube\Models\User;

/**
 * Authorizations define what an user can do in the backend or in the admin.
 * They can only be CRUD'ed by super admins. But they can be viewed by
 * any admin. Also, this is because client admins they can maintain users
 * and they would need to see what type of authorizations they have.
 * For instance, a client-admin can create other users that will also
 * be client-admins. But he cannot remove himself from being client-admin.
 */
class AuthorizationPolicy
{
    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
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