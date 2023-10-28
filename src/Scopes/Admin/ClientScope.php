<?php

namespace QRFeedz\Cube\Scopes\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use QRFeedz\Cube\Models\User;

class ClientScope implements Scope
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

        // Console commands. Don't apply global scopes.
        if (! $user) {
            return $builder;
        }

        /**
         * Attention to the relationships, since we can enter into a loop.
         * Like the verification of affiliate. We cannot use ->isAffiliate().
         */
        $isAffiliate = DB::table('clients')
                         ->where('user_affiliate_id', $user->id)
                         ->count() > 0;

        if ($isAffiliate) {
            // Affiliates can only see their own clients.
            return $builder->where('user_affiliate_id', $user->id);
        }

        if ($user->isSystemAdminLike()) {
            return $builder;
        }

        /**
         * On this case, if it's not a super admin, neither an admin,
         * neither an affiliate, it's related to a client. Doesn't matter.
         * We always show only the clients related to this user.
         */
        return $builder->where('id', $user->client_id);
    }
}
