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
}
