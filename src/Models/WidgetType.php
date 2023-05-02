<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WidgetType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_reportable' => 'boolean',
        'is_countable' => 'boolean',
        'is_full_page' => 'boolean',
    ];

    // Relationship validated.
    public function questions()
    {
        return $this->belongsToMany(Question::class)
                    ->using(QuestionWidgetType::class)
                    ->with(['id', 'widget_index', 'widget_data'])
                    ->withTimestamps();
    }

    public function questionWidget()
    {
        return $this->hasMany(QuestionWidget::class);
    }
}
