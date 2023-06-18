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

    /**
     * A widget instance itself has a caption, so this caption can be
     * translated in several languages. Therefore we have these
     * captions that will return all the caption locales that
     * were created.
     *
     * Source: locales.id
     * Relationship: validated
     */
    public function captions()
    {
        return $this->morphToMany(Locale::class, 'model')
                    ->with(['caption', 'placeholder'])
                    ->withTimestamps();
    }

    /**
     * The respective widget instance conditionals, in case they exist.
     *
     * Source: widget_instance_conditionals.id
     * Relationship: validated
     */
    public function widgetInstanceConditionals()
    {
        return $this->hasMany(WidgetInstanceConditional::class);
    }
}
