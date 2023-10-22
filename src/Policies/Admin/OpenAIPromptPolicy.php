<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelNovaHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\OpenAIPrompt;
use QRFeedz\Cube\Models\User;

/**
 * Not much rules for this model, can be viewed by users that have the client
 * under the locations and questionnaires for the current logged user if the
 * user is a client-admin.
 */
class OpenAIPromptPolicy
{
    use NovaHelpers;

    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, OpenAIPrompt $model)
    {
        return $user->isAllowedAdminAccess();
    }

    public function create(User $user)
    {
        return
            // Not via a parent resource detail view.
            ! via_resource() &&
            (
                // User is client admin.
                $user->isAtLeastAuthorizedAs('client-admin') ||

                // User is client admin.
                $user->isAtLeastAuthorizedAs('questionnaire-admin') ||

                // User is a kind of system admin.
                $user->isSystemAdminLike()
            );
    }

    public function update(User $user, OpenAIPrompt $model)
    {
        return
            // User is super admin.
            $user->isSuperAdmin() ||

            // User is an affiliate.
            $user->isAffiliate();
    }

    public function delete(User $user, OpenAIPrompt $model)
    {
        return
            // Model can be deleted.
            $model->canBeDeleted() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function restore(User $user, OpenAIPrompt $model)
    {
        return true;
    }

    public function forceDelete(User $user, OpenAIPrompt $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, OpenAiPrompt $model)
    {
        // Replication is disabled.
        return false;
    }
}
