<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

/**
 * Categories and tags are customizable attributes for client users.
 * Categories typically apply to establishments like restaurants,
 * hotels, and cafeterias, but users can create their own
 * categories as well.
 */
class Category extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * The related client, relationship exception via any polymorphic and
     * authorizable type.  A category is related to a client because
     * a category might not be attached to any questionnaire at the
     * moment of its creation.
     *
     * Source: categories.client_id
     * Relationship: validated
     */
    public function clients()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * A questionnaire can belong to a category. It's actually the main
     * categorization possible.
     *
     * Source: questionnaires.category_id
     * Relationship: validated
     */
    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class)
                    ->withTimestamps();
    }
}
