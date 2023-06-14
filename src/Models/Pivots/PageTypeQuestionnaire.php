<?php

namespace QRFeedz\Cube\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;
use QRFeedz\Cube\Concerns\HasAutoIncrementsByGroup;

class PageTypeQuestionnaire extends Pivot
{
    use HasAutoIncrementsByGroup;

    public $incrementing = true;

    protected $guarded = [];

    public function pageType()
    {
        return $this->belongsTo(Page::class);
    }

    // Relationship validated.
    public function questionInstances()
    {
        return $this->hasMany(QuestionInstance::class);
    }

    // Relationship validated.
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */

    /**
     * Returns the respective target view component. If it's overriden then
     * returns the updated one.
     */
    public function targetViewComponent()
    {
        return $this->view_component_override ??
               $this->pageType->view_component_namespace;
    }
}
