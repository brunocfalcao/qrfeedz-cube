<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Widget extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_reportable' => 'boolean',
        'is_countable' => 'boolean',
        'is_full_page' => 'boolean',
    ];

    /**
     * The related questions where the respective widget is being used.
     *
     * Source: questions.id
     * Relationship: validated
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class)
                    ->with(['widget_index', 'widget_data'])
                    ->withTimestamps();
    }

    // TODO: Connection with WidgetInstance model (WidgetInstance)
    public function instances()
    {
    }
}
