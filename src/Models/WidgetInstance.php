<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class WidgetInstance extends QRFeedzModel
{
    use SoftDeletes;

    protected $casts = [
        'data' => 'array',
        'when' => 'array',
        'then' => 'array',
    ];

    /**
     * Source: question_instances.id
     * Relationship: validated
     * Relationship ID: 20
     */
    public function questionInstance()
    {
        return $this->belongsTo(QuestionInstance::class);
    }

    /**
     * Source: widgets.id
     * Relationship: validated
     * Relationship ID: 22
     */
    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }

    /**
     * Source: responses.id
     * Relationship: validated
     * Relationship ID: 28
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */
    public function canBeDeleted()
    {
        // Can't be deleted if it does have responses attached to it.
        return ! $this->responses()->exists();
    }

    /** ---------------------- DEFAULT VALUES ------------------------------- */
    public function defaultUuidAttribute()
    {
        return (string) Str::uuid();
    }
}
