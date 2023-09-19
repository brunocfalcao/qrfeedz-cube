<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

/**
 * An authorization is an abstract permission that allows users to have
 * specific type of authorizations over other model instances. The
 * models considered are clients, questionnaires and groups.
 * Categories are not considered for authorization since
 * users will always have access to all categories from
 * that client context.
 */
class Authorization extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * An user would have a specific permission to a client. The permission
     * will then cascade to the child entities (questionnaires, tags, etc)
     * in case that specific permission is unspecified.
     *
     * Source: authorizables.authorizable_type = 'Client' + authorizable_id
     * Relationship: verified.
     */
    public function clients()
    {
        return $this->morphedByMany(Client::class, 'model', 'authorizables')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    /**
     * Defines what permission should each user have to the questionnaire.
     *
     * Source: authorizables.authorizable_type = 'Questionnaire' + authorizable_id
     * Relationship: verified.
     */
    public function questionnaires()
    {
        return $this->morphedByMany(Questionnaire::class, 'model', 'authorizables')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    public function locations()
    {
        return $this->morphedByMany(Location::class, 'model', 'authorizables')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */

    /**
     * Decides if an eloquent model can be deleted, so all the conditions need
     * to meet before the instance is deleted. Can be used for force delete too.
     */
    public function canBeDeleted()
    {
        return
            // No clients relationship items.
            $this->clients()->count() == 0 &&

            // No questionnaire relationship items.
            $this->questionnaires()->count() == 0;
    }
}
