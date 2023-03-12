<?php

namespace QRFeedz\Cube\Concerns;

use Illuminate\Database\Eloquent\Model;
use QRFeedz\Cube\Models\Authorization;

/**
 * Very specific trait to help managing authorizations to qrfeedz users.
 */
trait ConcernsAuthorizations
{
    public function assignAuthorization(Authorization $authorization, Model $entity)
    {
        $entity->authorizations()->attach(
            $authorization,
            ['user_id' => $this->id]
        );

        return $this;
    }
}
