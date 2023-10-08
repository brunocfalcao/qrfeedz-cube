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
     * Source: widget_instances.id
     * Relationship: validated
     * Relationship ID: 35
     */
    public function parentWidgetInstance()
    {
        return $this->belongsTo(WidgetInstance::class, 'widget_instance_id');
    }

    /**
     * Source: widget_instances.id
     * Relationship: validated
     * Relationship ID: 10
     */
    public function childWidgetInstances()
    {
        return $this->hasMany(WidgetInstance::class, 'widget_instance_id');
    }

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
     * Source: locales.id
     * Relationship: validated
     * Relationship ID: 23
     */
    public function captions()
    {
        return $this->morphToMany(Locale::class, 'model', 'localables')
                    ->withPivot(['caption', 'placeholder'])
                    ->withTimestamps();
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
