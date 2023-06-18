<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WidgetInstanceConditional extends Model
{
    use SoftDeletes;

    protected $guarded = [];

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

    // Relationship verified.
    public function captions()
    {
        return $this->morphToMany(Locale::class, 'model')
                    ->with(['caption', 'placeholder'])
                    ->withTimestamps();
    }
}
