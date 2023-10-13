<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\QuestionInstance;
use QRFeedz\Cube\Models\User;

class QuestionInstancePolicy
{
    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, QuestionInstance $model)
    {
        return $user->isAllowedAdminAccess();
    }

    public function create(User $user)
    {
        return
            // User is super admin.
            $user->isSuperAdmin() ||

            // User is an affiliate.
            $user->isAffiliate();
    }

    public function update(User $user, QuestionInstance $model)
    {
        return
            // User is super admin.
            $user->isSuperAdmin() ||

            // User is an affiliate.
            $user->isAffiliate();
    }

    public function delete(User $user, QuestionInstance $model)
    {
        return
            // Model can be deleted.
            $model->canBeDeleted() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function restore(User $user, QuestionInstance $model)
    {
        return false;
    }

    public function forceDelete(User $user, QuestionInstance $model)
    {
        return false;
    }

    public function replicate(User $user, QuestionInstance $model)
    {
        // Replication is disabled.
        return false;
    }

    public function addResponse(User $user, QuestionInstance $model)
    {
        // Responses cannot be created in Question instances.
        return false;
    }
}
