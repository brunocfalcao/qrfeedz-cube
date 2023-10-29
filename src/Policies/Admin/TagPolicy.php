<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\Tag;
use QRFeedz\Cube\Models\User;

/**
 * Tags are only shown to the questionnaire tags belonging to the user client.
 * So, first the user creates a Tag and attaches it to a questionnaire, then
 * this tag can be used for more questionnaires.
 */
class TagPolicy
{
    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, Tag $model)
    {
        return $user->isAllowedAdminAccess();
    }

    public function create(User $user)
    {
        return
            // Not via a parent resource detail view.
            ! via_resource();
    }

    public function update(User $user, Tag $model)
    {
        return true;
    }

    public function delete(User $user, Tag $model)
    {
        return
            // Model can be deleted.
            $model->canBeDeleted() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function restore(User $user, Tag $model)
    {
        return $model->trashed() && $user->isSuperAdmin();
    }

    public function forceDelete(User $user, Tag $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, Tag $model)
    {
        // Replication is disabled.
        return false;
    }
}
