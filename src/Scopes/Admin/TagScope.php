<?php

namespace QRFeedz\Cube\Scopes\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use QRFeedz\Cube\Models\QuestionnaireAuthorization;
use QRFeedz\Cube\Models\User;

class TagScope implements Scope
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

        /**
         * Returns the tags that are part of the client questionnaires
         * of the logged user.
         */
        $clients = ClientAuthorizations::getWhere('user_id', $user->id);
        $questionnaires = QuestionnaireAuthorization::getWhere('user_id', $user->id);

        $builder->upTo('questionnaires')
                ->upTo('locations')
                ->upTo('clients');

        if ($clients) {
            $builder->whereIn('clients.id', $clients->pluck('id'));
        }

        if ($questionnaires) {
            $builder->whereIn('questionnaires.id', $questionnaires->pluck('id'));
        }

        return $builder;
    }
}
