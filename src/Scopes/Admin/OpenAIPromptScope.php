<?php

namespace QRFeedz\Cube\Scopes\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use QRFeedz\Cube\Models\User;

class OpenAIPromptScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $user = Auth::id() ?
                User::firstWhere('id', Auth::id()) :
                null;

        // No user or running in console? Exit.
        if (! $user ||
            app()->runningInConsole() ||
            $user->isSystemAdminLike()) {
            return $builder;
        }

        return $builder->upTo('questionnaires')
                       ->upTo('locations')
                       ->upTo('clients')
                       ->where('clients.id', $user->client->id);
    }
}
