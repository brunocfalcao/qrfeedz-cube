<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\User;

/**
 * The users are filtered by the client users in case it's a client admin.
 */
class UserPolicy
{
    public function viewAny(User $user)
    {
        // Anyone registered can view user resources.
        return $user->isAllowedAdminAccess();
    }

    public function view(User $user, User $model)
    {
        return
            // The user is a super admin.
            $user->isSuperAdmin() ||
            (
                // The user instance and the user belong to the same client.
                $model->client_id == $user->client_id &&

                // The user has an "client admin" authorization.
                $user->isAuthorizedAs($user->client, 'client-admin')

            ) ||
            // The user is himself.
            $model->id == $user->id;
    }

    public function create(User $user)
    {
        return
            (
                // The user is a super admin.
                $user->isSuperAdmin() ||

                // The user has at least one "admin" authorization.
                $user->isAtLeastAuthorizedAs('client-admin')
            ) &&
            // Not via a parent resource detail view.
            ! via_resource();
    }

    public function update(User $user, User $model)
    {
        return
            // The user is a super admin.
            $user->isSuperAdmin() ||

            // The user is himself.
            $model->id == $user->id ||

            // The user has an "admin" authorization on the model instance.
            $user->isAuthorizedAs($model->client, 'client-admin');
    }

    public function delete(User $user, User $model)
    {
        return
            (
                // The user is a super admin.
                $user->isSuperAdmin() ||

                // The user has an "admin" authorization on the model instance.
                $user->isAuthorizedAs($model->client, 'client-admin')
            ) &&

            // Model can be deleted.
            $model->canBeDeleted() &&

            // The user cannot delete himself.
            $user->id != $model->id;
    }

    public function restore(User $user, User $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&
            (
                // The user has an "affiliate" authorization on this client.
                $user->isAffiliateOf($model->client) ||

                // The user is a super admin.
                $user->isSuperAdmin() ||

                // The user has an "admin" authorization on the model instance.
                $user->isAuthorizedAs($model->client, 'client-admin')
            );
    }

    public function forceDelete(User $user, User $model)
    {
        return
            // Model is previously soft deleted.
            $model->trashed() &&

            // User is super admin.
            $user->isSuperAdmin();
    }

    public function replicate(User $user, User $model)
    {
        return false;
    }
}
