<?php

namespace QRFeedz\Cube\Scopes\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use QRFeedz\Cube\Models\User;

class QuestionnaireScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $user = Auth::id() ?
                User::withoutGlobalScope($this)->firstWhere('id', Auth::id()) :
                null;

        // Console commands. Don't apply global scopes.
        if (! $user) {
            return $builder;
        }

        if ($user->isSystemAdminLike()) {
            return $builder;
        }

        // User is affiliate. Return all questionnaires from his clients.
        if ($user->isAffiliate()) {
            return $builder->upTo('locations')
                       ->upTo('questionnaires')
                       ->upTo('clients')
                       ->bring('users')
                       ->where('clients.user_affiliate_id', $user->id);
        }

        // The user is related with a client.
        return $builder->upTo('locations')
                       ->upTo('questionnaires')
                       ->upTo('clients')
                       ->bring('users')
                       ->where('users.client_id', $user->id);
    }
}
