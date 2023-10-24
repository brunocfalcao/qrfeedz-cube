<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Response extends QRFeedzModel
{
    use SoftDeletes;

    protected $casts = [
        'value' => 'array',
    ];

    /**
     * Source: question_instances.id
     * Relationship: validated
     * Relationship ID: 19
     */
    public function questionInstance()
    {
        return $this->belongsTo(QuestionInstance::class);
    }

    /**
     * Source: widget_instances.id
     * Relationship: validated
     * Relationship ID: 28
     */
    public function widgetInstance()
    {
        return $this->belongsTo(WidgetInstance::class);
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */
    public function canBeDeleted()
    {
        // We can never delete a response. That was given by visitor.
        return false;
    }
}
