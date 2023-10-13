<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelNovaHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\QuestionnaireAuthorization;
use QRFeedz\Cube\Models\User;

/**
 * Countries can't be deleted or changed. Period.
 */
class QuestionnaireAuthorizationPolicy
{
    use NovaHelpers;

    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, QuestionnaireAuthorization $model)
    {
        return $user->isAllowedAdminAccess();
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, QuestionnaireAuthorization $model)
    {
        return true;
    }

    public function delete(User $user, QuestionnaireAuthorization $model)
    {
        return
            // Model can be deleted.
            $model->canBeDeleted() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function restore(User $user, QuestionnaireAuthorization $model)
    {
        // Only if it was trashed.
        return $model->trashed();
    }

    public function forceDelete(User $user, QuestionnaireAuthorization $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, QuestionnaireAuthorization $model)
    {
        // Replication is disabled.
        return false;
    }
}
