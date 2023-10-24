<?php

namespace QRFeedz\Cube\Scopes\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use QRFeedz\Cube\Models\User;

class LocationScope implements Scope
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

        if ($user->isAffiliate()) {
            return $builder->upTo('clients')
                           ->whereIn(
                               'clients.id',
                               $user->clients->pluck('id')
                           );
        }

        if ($user->isAtLeastAuthorizedAs('client-admin') ||
            $user->isAtLeastAuthorizedAs('questionnaire-admin')) {
            return
            $builder->upTo('clients')
                    ->where('clients.id', $user->client->id);
        }
    }
}
