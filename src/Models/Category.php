<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Category extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * A system-assigned category will have several questionnaires from its
     * value.
     *
     * Source: questionnaires.category_id
     * Relationship: validated
     */
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }
}
