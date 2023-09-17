<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\Category;
use QRFeedz\Cube\Models\User;

class CategoryPolicy
{
    public function viewAny(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, Category $model)
    {
        return $user->isSuperAdmin();
    }

    public function create(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function update(User $user, Category $model)
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, Category $model)
    {
        return ! (
            // User is super admin.
            $user->isSuperAdmin() &&

            // There are no questionnaires related with this category.
            ! $model->questionnaires()->withTrashed()->exists()
        );
    }

    public function restore(User $user, Category $model)
    {
        return $user->isSuperAdmin();
    }

    public function forceDelete(User $user, Category $model)
    {
        return ! (
            // User is super admin.
            $user->isSuperAdmin() &&

            // There are no questionnaires related with this category.
            ! $model->questionnaires()->withTrashed()->exists()
        );
    }

    public function replicate(User $user, Category $model)
    {
        return false;
    }
}
