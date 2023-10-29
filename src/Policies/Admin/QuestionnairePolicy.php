<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelNovaHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\Questionnaire;
use QRFeedz\Cube\Models\User;

/**
 * Questionnaires can be created by client-admins, affiliates and
 * questionnaire-admins.
 */
class QuestionnairePolicy
{
    use NovaHelpers;

    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, Questionnaire $model)
    {
        return $user->isAllowedAdminAccess();
    }

    public function create(User $user)
    {
        return
            (
                // User is super admin.
                $user->isSuperAdmin() ||

                // User is affiliate.
                $user->isAffiliate() ||

                // User is client-admin.
                $user->isAtLeastAuthorizedAs('client-admin')
            ) &&

            // Not via a parent resource detail view.
            ! via_resource();
    }

    public function update(User $user, Questionnaire $model)
    {
        /**
         * Super admin? All good.
         */
        if ($user->isSystemAdminLike()) {
            return true;
        }

        // Client admin or questionnaire admin? That's okay.
        if ($user->isAtLeastAuthorizedAs('client-admin') ||
            $user->isAtLeastAuthorizedAs('questionnaire-admin')) {
            return $model->location->client->id == $user->client_id;
        }

        return false;
    }

    public function delete(User $user, Questionnaire $model)
    {
        return
            // Model can be deleted.
            $model->canBeDeleted() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function restore(User $user, Questionnaire $model)
    {
        return $model->trashed() && $user->isSuperAdmin();
    }

    public function forceDelete(User $user, Questionnaire $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, Questionnaire $model)
    {
        // Replication is disabled.
        return false;
    }
}
