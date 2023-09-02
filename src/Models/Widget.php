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
     * Related widget instance that is using this widget.
     *
     * Source: widget_instances.od
     * Relationship: validated
     */
    public function widgetInstances()
    {
        return $this->hasMany(WidgetInstance::class);
    }
}
