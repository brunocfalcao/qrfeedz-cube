<?php

namespace QRFeedz\Cube\Policies\Admin;

use QRFeedz\Cube\Models\User;
use QRFeedz\Cube\Models\Widget;

class WidgetPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Widget $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Widget $model)
    {
        return true;
    }

    public function delete(User $user, Widget $model)
    {
        return true;
    }

    public function restore(User $user, Widget $model)
    {
        return true;
    }

    public function forceDelete(User $user, Widget $model)
    {
        return true;
    }
}
