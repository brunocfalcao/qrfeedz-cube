<?php

namespace QRFeedz\Cube\Scopes\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use QRFeedz\Cube\Models\User;

class UserScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $user = Auth::id() ?
                User::withoutGlobalScope($this)->firstWhere('id', Auth::id()) :
                null;

        // No user or running in console? Exit.
        if (! $user ||
            app()->runningInConsole() ||
            $user->isSystemAdminLike()) {
            return $builder;
        }

        // Scope the responses only for the allowed user client.
        return $builder
            ->bring('clients')
            ->when($user->isAtLeastAuthorizedAs('client-admin'), function ($query) use ($user) {
                // Obtain the users where the user client is client-admin.
                $query->whereIn(
                    'clients.id',
                    $user->authorizationsAs('client-admin')
                         ->pluck('model_id')
                );
            })
            ->when($user->isAtLeastAuthorizedAs('location-admin'), function ($query) use ($user) {
                // Obtain the clients where the user is location-admin.
                $query->whereIn(
                    'locations.id',
                    $user->authorizationsAs('location-admin')
                         ->pluck('model_id')
                );
            })
            ->where('users.id', $user->id);
    }
}
