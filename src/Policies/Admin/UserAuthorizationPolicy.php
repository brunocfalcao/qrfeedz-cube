<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\User;
use QRFeedz\Cube\Models\UserAuthorization;

/**
 * Categories are system groups assigned to questionnaires. As example,
 * categories can be products, restaurants, hotels, etc. Each of these
 * categories will have computed logic on itself. For instance, if
 * a client has questionnaires type=hotel, then it will group the
 * hotel and questionnaires per room.
 */
class UserAuthorizationPolicy
{
    use NovaHelpers;

    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, UserAuthorization $model)
    {
        return $user->isAllowedAdminAccess();
    }

    public function create(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function update(User $user, UserAuthorization $model)
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, UserAuthorization $model)
    {
        return true;

        return
            // Model can be deleted.
            $model->canBeDeleted() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function restore(User $user, UserAuthorization $model)
    {
        return $user->isSuperAdmin();
    }

    public function forceDelete(User $user, UserAuthorization $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, UserAuthorization $model)
    {
        return false;
    }
}
