<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

/**
 * An authorization is an abstract permission that allows users to have
 * specific type of authorizations over questionnaires and locations.
 * They are mapped under the AuthorizationQuestionnaire and the
 * AuthorizationClient (for now). Later we'll think about
 * other type of authorizations and what they would be
 * used for (GDPR, view-only, etc).
 */
class Authorization extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * Source: client_authorizations.authorization_id
     * Relationship:
     */
    public function clientAuthorizations()
    {
        return $this->hasMany(ClientAuthorization::class);
    }

    /**
     * Source: questionnaire_authorizations.authorization_id
     * Relationship:
     */
    public function questionnaireAuthorizations()
    {
        return $this->hasMany(QuestionnaireAuthorization::class);
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */
    public function canBeDeleted()
    {
        return true;
        /**
         * Only if this authorization id is not being used on
         * on other any authorization lines.
         */
        /*
        DB::table('authorizables')
          ->where('authorization_id', $this->id)
          ->count() == 0;
        */
    }
}
