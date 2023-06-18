<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Widget extends Model
{
    use SoftDeletes;

    protected $guarded = [];

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
        return $this->hasMany(WidgetInstance::class)
                    ->withTimestamps();
    }
}
