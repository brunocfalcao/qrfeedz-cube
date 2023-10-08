<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
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
     * Relationship ID: 6
     */
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */
    public function canBeDeleted()
    {
        return
            /**
             * Only if there is no questionnaire with this category, force
             * deleted. If they are soft deleted, this category cannot
             * be deleted.
             */
            DB::table('questionnaires')
              ->where('category_id', $this->id)
              ->count() == 0;
    }
}
