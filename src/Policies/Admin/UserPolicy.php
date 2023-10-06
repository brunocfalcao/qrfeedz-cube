<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\User;

class UserPolicy
{
    public function viewAny(User $user)
    {
        // Anyone registered can view user resources.
        return true;
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
            // The user is a super admin.
            $user->isSuperAdmin() ||

            // The user has at least one "admin" authorization.
            $user->isAtLeastAuthorizedAs('client-admin');
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

            // The user cannot delete himself.
            $user->id != $model->id;
    }

    public function restore(User $user, User $model)
    {
        return
            // The user has an "affiliate" authorization on this client.
            $user->isAffiliateOf($model->client) ||

            // The user is a super admin.
            $user->isSuperAdmin() ||

            // The user has an "admin" authorization on the model instance.
            $user->isAuthorizedAs($model->client, 'client-admin');
    }

    public function forceDelete(User $user, User $model)
    {
        // The user is a super admin.
        return $user->isSuperAdmin();
    }

    public function replicate(User $user, User $model)
    {
        return false;
    }

    public function addUserAuthorization(User $user)
    {
        return true;
    }
}
