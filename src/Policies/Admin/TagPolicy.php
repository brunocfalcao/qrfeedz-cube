<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\Tag;
use QRFeedz\Cube\Models\User;

class TagPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Tag $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
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
        return true;
    }

    public function forceDelete(User $user, Tag $model)
    {
        return true;
    }
}
