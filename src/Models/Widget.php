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
     * Source: question_instances.id
     * Relationship: validated
     */
    public function questionIntances()
    {
        return $this->belongsToMany(QuestionInstance::class)
                    ->with(['widget_index', 'widget_data'])
                    ->withTimestamps();
    }

    // TODO: Connection with WidgetInstance model (WidgetInstance)
    public function instances()
    {
    }
}
