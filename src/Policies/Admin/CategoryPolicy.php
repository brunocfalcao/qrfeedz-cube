<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\Category;
use QRFeedz\Cube\Models\User;

/**
 * Categories are system groups assigned to questionnaires. As example,
 * categories can be products, restaurants, hotels, etc. Each of these
 * categories will have computed logic on itself. For instance, if
 * a client has questionnaires type=hotel, then it will group the
 * hotel and questionnaires per room.
 */
class CategoryPolicy
{
    use NovaHelpers;

    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, Category $model)
    {
        return $user->isAllowedAdminAccess();
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
        return true;

        return
            // Model can be deleted.
            $model->canBeDeleted() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function restore(User $user, Category $model)
    {
        return $user->isSuperAdmin();
    }

    public function forceDelete(User $user, Category $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, Category $model)
    {
        return false;
    }

    public function addQuestionnaire(User $user, Category $model)
    {
        /**
         * In case we are in the create category, we can add a new
         * questionnaire. In case we are in the detail view of the
         * category, we cannot add a questionnaire.
         */
        return ! ($this->novaContext() == 'detail');
    }
}
