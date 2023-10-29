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
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function canBeDeleted()
    {
        // Nothing specific to compute, at the moment.
        return true;
    }
}
