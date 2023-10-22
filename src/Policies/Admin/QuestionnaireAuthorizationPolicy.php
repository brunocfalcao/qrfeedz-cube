<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelNovaHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\QuestionnaireAuthorization;
use QRFeedz\Cube\Models\User;

/**
 * Questionnaire policies are managed by admin or client-admin users, or by
 * questionnaire-admin users.
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
        return
            (
                // Admin or system admin.
                $user->isSystemAdminLike() ||

                // User is 'client-admin'.
                $user->isAtLeastAuthorizedAs('client-admin') ||

                // User is 'questionnaire-admin'.
                $user->isAtLeastAuthorizedAs('questionnaire-admin')
            ) &&

            // Not via a parent resource detail view.
            ! via_resource();
    }

    public function update(User $user, QuestionnaireAuthorization $model)
    {
        return
            (
                // Admin or system admin.
                $user->isSystemAdminLike() ||

                // User is 'client-admin'.
                $user->isAtLeastAuthorizedAs('client-admin') ||

                // User is 'questionnaire-admin'.
                $user->isAtLeastAuthorizedAs('questionnaire-admin')
            ) &&

            // The resource is not being created via the users resource.
            ! via_resource('users');
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
