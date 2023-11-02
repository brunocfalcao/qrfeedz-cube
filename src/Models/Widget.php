<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Widget extends QRFeedzModel
{
    use SoftDeletes;

    protected $casts = [
        'is_progressable' => 'boolean',
        'is_full_page' => 'boolean',
    ];

    /**
     * Source: widget_instances.od
     * Relationship: validated
     * Relationship ID: 22
     */
    public function widgetInstances()
    {
        return $this->hasMany(WidgetInstance::class);
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

    public function canBeDeleted()
    {
        // For now we don't delete it.
        return false;
    }
}
