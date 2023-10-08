<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class QuestionnaireAuthorization extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * Source: questionnaires.id
     * Relationship:
     */
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    /**
     * Source: users.id
     * Relationship:
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Source: authorizations.id
     * Relationship:
     */
    public function authorization()
    {
        return $this->belongsTo(Authorization::class);
    }
}
