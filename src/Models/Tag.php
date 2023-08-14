<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Tag extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * Tags that are related with clients. The client tags are reserved only
     * for super admin management.
     *
     * Source: clients.id
     * Relationship: validated
     */
    public function clients()
    {
        return $this->belongsToMany(Client::class)
                    ->withTimestamps();
    }

    /**
     * Tags related to the questionnaire, they are added by admin users
     * that belong to the respective questionnaire client.
     *
     * Source: questionnaire.id
     * Relationship:
     */
    public function questionnaires()
    {
        return $this->morphedByMany(Questionnaire::class, 'model', 'taggables');
    }
}
