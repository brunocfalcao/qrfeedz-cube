<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelNovaHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\Questionnaire;
use QRFeedz\Cube\Models\User;

class QuestionnairePolicy
{
    use NovaHelpers;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Questionnaire $model)
    {
        /**
         * Super admin? All good.
         */
        if ($user->isSuperAdmin()) {
            return true;
        }

        /**
         * Return questionnaires that are part of this user as client admin.
         */
        if ($user->isAtLeastAuthorizedAs('client-admin')) {
            return $model->client_id == $user->client_id;
        }

        return false;
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
        if ($user->isSuperAdmin()) {
            return true;
        }

        /**
         * Return questionnaires that are part of this user as client admin.
         */
        if ($user->isAtLeastAuthorizedAs('client-admin')) {
            return $model->client_id == $user->client_id;
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
        return false;
    }

    public function forceDelete(User $user, Questionnaire $model)
    {
        return false;
    }

    public function replicate(User $user, Questionnaire $model)
    {
        // Replication is disabled.
        return false;
    }

    public function addOpenAIPrompt(User $user, Questionnaire $model)
    {
        // Cannot resume policy on detail, only.
        return ! ($this->novaGetContext() == 'detail');
    }

    public function attachAnyAuthorization(User $user, Questionnaire $model)
    {
        // Cannot resume policy on detail, only.
        return ! ($this->novaGetContext() == 'detail');
    }
}
