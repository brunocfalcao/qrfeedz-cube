<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelNovaHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\QuestionInstance;
use QRFeedz\Cube\Models\User;

/**
 * Not much to be done here in terms of policies, except they are created
 * mostly by admin users. A question instance is very specific to the
 * questionnaire structure creation and maintenance so it needs to be
 * performed by an expert person.
 */
class QuestionInstancePolicy
{
    use NovaHelpers;

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
            // Not via a parent resource detail view.
            ! via_resource() &&

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
        return $model->trashed() && $user->isSuperAdmin();
    }

    public function forceDelete(User $user, QuestionInstance $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, QuestionInstance $model)
    {
        // Replication is disabled.
        return false;
    }
}
