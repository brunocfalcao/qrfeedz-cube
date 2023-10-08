<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class QuestionnaireAuthorization extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * Source: questionnaires.id
     * Relationship: validated
     * Relationship ID: 31
     */
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    /**
     * Source: users.id
     * Relationship: validated
     * Relationship ID: 32
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Source: authorizations.id
     * Relationship: validated
     * Relationship ID: 29
     */
    public function authorization()
    {
        return $this->belongsTo(Authorization::class);
    }
}
