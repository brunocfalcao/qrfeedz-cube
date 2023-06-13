<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Relationship between what pages are part of the related questionnaire.
     * The N-N table (page_instances) is also a model that will show
     * what page instances will be created for each questionnaire.
     *
     * Source: questionnaires.id
     * Relationship: validated
     */
    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class, 'page_instances')
                    ->withPivot(['index', 'group', 'view_component_override'])
                    ->withTimestamps();
    }
}
