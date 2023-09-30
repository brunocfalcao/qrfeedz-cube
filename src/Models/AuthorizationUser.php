<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

/**
 * An authorization is an abstract permission that allows users to have
 * specific type of authorizations over other model instances. The
 * models considered are clients, questionnaires and groups.
 * Categories are not considered for authorization since
 * users will always have access to all categories from
 * that client context.
 */
class AuthorizationUser extends MorphPivot
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
