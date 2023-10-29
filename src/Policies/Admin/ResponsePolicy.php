<?php

namespace QRFeedz\Cube\Policies\Admin;

use Brunocfalcao\LaravelNovaHelpers\Traits\NovaHelpers;
use QRFeedz\Cube\Models\Response;
use QRFeedz\Cube\Models\User;
use QRFeedz\Services\Facades\QRFeedz;

/**
 * Responses can only be seen by the ones that are part of this questionnaire
 * or by the ones part of this client scope. Still, most of this is already
 * based on the global scope applied to the response query builder.
 */
class ResponsePolicy
{
    use NovaHelpers;

    public function viewAny(User $user)
    {
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, Response $model)
    {
        return
            // User is super admin.
            $user->isSuperAdmin() ||
            (
                // User is allowed to access admin.
                $user->isAllowedAdminAccess() &&

                // The response is part of a client that belongs to the user.
                $model->questionInstance
                      ->pageInstance
                      ->questionnaire
                      ->location
                      ->client
                      ->id == $user->client_id
            );
    }

    public function create(User $user)
    {
        return
            // Only created by the qrfeedz frontend.
            QRFeedz::inFrontend() &&

            // Only under a questionnaire execution context.
            QRFeedz::hasValidSessionId() &&

            // Not via a parent resource detail view.
            ! via_resource();
    }

    public function update(User $user, Response $model)
    {
        /**
         * Responses can only be updated by the same visitor session id from
         * this questionnaire.
         */
        return QRFeedz::inFrontend() && QRFeedz::hasValidSessionId();
    }

    public function delete(User $user, Response $model)
    {
        /**
         * Responses can only be deleted by the same visitor session id from
         * this questionnaire. Still, it's important to understand that a
         * data deletion is not very normal. For instance, if a visitor clears
         * a textbox, then it might be considered a "delete value" or if the
         * visitor changes a star rating value.
         *
         * No one else, not either super admins, can delete response values.
         */
        return QRFeedz::inFrontend() && QRFeedz::hasValidSessionId();
    }

    public function restore(User $user, Response $model)
    {
        return $model->trashed() && $user->isSuperAdmin();
    }

    public function forceDelete(User $user, Response $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, Response $model)
    {
        // Replication is disabled.
        return false;
    }
}
