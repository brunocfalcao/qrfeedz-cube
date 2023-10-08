<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Tag extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * Source: questionnaire.id
     * Relationship: validated
     * Relationship ID: 13
     */
    public function questionnaires()
    {
        return $this->morphedByMany(Questionnaire::class, 'model', 'taggables')
                    ->withTimestamps();
    }
}
