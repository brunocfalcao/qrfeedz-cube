<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use QRFeedz\Cube\Concerns\HasAutoIncrementsByGroup;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

/**
 * The page instance model is a model-pivot that will show what pages
 * where created per questionnaire. It has an id that will be then related
 * with questions, widgets, and so on.
 *
 * The page instance table is the pivot table page_instances.
 *
 * A page instance is an unique instance creation of a page in a questionnaire
 * and is of type of the Page model.
 */
class PageInstance extends QRFeedzModel
{
    use HasAutoIncrementsByGroup, SoftDeletes;

    protected $appends = [
        'view_component',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * A page instance can have (although not recommended) several questions
     * on its own page.
     *
     * Source: question_instances.id
     * Relationship: validated
     */
    public function questionInstances()
    {
        return $this->hasMany(QuestionInstance::class);
    }

    /**
     * Related page.
     *
     * Source: pages.id
     * Relationship: validated
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * What is the related questionnaire that this page instance belongs to.
     *
     * Source: questionnaires.id
     * Relationship: validated
     */
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
    public function getViewComponentAttribute()
    {
        return $this->view_component_override ??
               $this->page->view_component_namespace;
    }

    /** ---------------------- DEFAULT VALUES ------------------------------- */
    public function defaultIndexAttribute()
    {
        return $this->incrementByGroup([
            'questionnaire_id',
            'page_id',
            'group',
        ]);
    }

    public function defaultUuidAttribute()
    {
        return (string) Str::uuid();
    }
}
