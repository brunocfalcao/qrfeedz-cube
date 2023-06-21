<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class WidgetInstanceConditional extends QRFeedzModel
{
    use SoftDeletes;

    protected $casts = [
        'when' => 'array',
        'then' => 'array',
    ];

    /**
     * The related parent widget instance.
     *
     * Source: widget_instances.id
     * Relationship: validated
     */
    public function widgetInstance()
    {
        return $this->belongsTo(WidgetInstance::class);
    }

    /**
     * Related condition locales.
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
}
