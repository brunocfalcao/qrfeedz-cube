<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WidgetInstance extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [];

    /**
     * Related question instance.
     *
     * Source: question_instances.id
     * Relationship: validated
     */
    public function questionInstance()
    {
        return $this->belongsTo(QuestionInstance::class);
    }

    /**
     * Related widget that is the source of this widget instance.
     *
     * Source: widgets.id
     * Relationship: validated
     */
    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }
}
