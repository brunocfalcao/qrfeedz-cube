<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The page instance model is a model-pivot that will show what pages
 * where created per questionnaire. It has an id that will be then related
 * with questions, widgets, and so on.
 *
 * The page instance table is the pivot table page_instances.
 *
 * A page instance is an unique instance creation of a page in a questionnaire
 * and is of type of the Page model.
 *
 */
class PageInstance extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];

    /**
     * A page instance can have (although not recommended) have several
     * questions on its own page.
     *
     * Source: question_instances.id
     * Relationship: validated
     */
    public function questionInstances()
    {
        return $this->hasMany(QuestionInstance::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
