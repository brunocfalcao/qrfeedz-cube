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
        return $this->morphedByMany(Client::class, 'model')
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
        return $this->morphedByMany(Questionnaire::class, 'model')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    /**
     * Defines what permission should each user have to the group.
     *
     * Source: authorizables.authorizable_type = 'Group' + authorizable_id
     * Relationship: verified.
     */
    public function groups()
    {
        return $this->morphedByMany(Group::class, 'model')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }
}
