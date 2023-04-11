<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Cube\Concerns\HasAutoIncrementsByGroup;

class PageTypeQuestionnaire extends Pivot
{
    use HasAutoIncrementsByGroup;
    use SoftDeletes;

    public $table = 'page_type_questionnaire';

    public $incrementing = true;

    protected $guarded = [];

    public function pageType()
    {
        return $this->belongsTo(PageType::class);
    }

    // Relationship validated.
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Relationship validated.
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function targetViewComponent()
    {
        return $this->view_component_override ??
        $this->pageType->view_component;
    }
}
