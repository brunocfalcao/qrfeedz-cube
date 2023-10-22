<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\OpenAIPrompt;
use QRFeedz\Cube\Models\User;

class OpenAIPromptPolicy
{
    public function viewAny(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, OpenAIPrompt $model)
    {
        return $user->isSuperAdmin();
    }

    public function create(User $user)
    {
        return
            // Not via a parent resource detail view.
            ! via_resource() &&

            // User is super admin.
            $user->isSuperAdmin();
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
        return false;
    }

    public function forceDelete(User $user, OpenAIPrompt $model)
    {
        return false;
    }

    public function replicate(User $user, OpenAiPrompt $model)
    {
        // Replication is disabled.
        return false;
    }
}
