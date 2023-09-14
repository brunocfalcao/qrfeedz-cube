<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use QRFeedz\Cube\Concerns\HasAutoIncrementsByGroup;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class WidgetInstance extends QRFeedzModel
{
    use HasAutoIncrementsByGroup, SoftDeletes;

    protected $casts = [
        'data' => 'array',
        'when' => 'array',
        'then' => 'array',
    ];

    /**
     * Related parent widget, in case this instance is a widget child instance.
     *
     * Source: widget_instances.id
     * Relationship: validated
     */
    public function parentWidgetInstance()
    {
        return $this->belongsTo(WidgetInstance::class, 'widget_instance_id');
    }

    /**
     * Related child widgets, in case they are widget conditional instances.
     *
     * Source: widget_instances.id
     * Relationship: validated
     */
    public function childWidgetInstances()
    {
        return $this->hasMany(WidgetInstance::class, 'widget_instance_id');
    }

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
        return $this->morphToMany(Locale::class, 'model', 'localables')
                    ->withPivot(['caption', 'placeholder'])
                    ->withTimestamps();
    }

    /**
     * The responses that were given relatively to this widget instance.
     *
     * Source: responses.id
     * Relationship: validated
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    /** ---------------------- DEFAULT VALUES ------------------------------- */
    public function defaultIndexAttribute()
    {
        // Don't apply for widget instance conditionals.
        if (! $this->widget_instance_id) {
            return $this->incrementByGroup('question_instance_id');
        }
    }

    public function defaultUuidAttribute()
    {
        return (string) Str::uuid();
    }
}
