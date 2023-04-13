<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionWidgetTypeConditional extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'when' => 'array',
        'then' => 'array',
    ];

    // Relationship validated.
    public function questionWidgetType()
    {
        return $this->belongsTo(QuestionWidgetType::class);
    }

    // Relationship verified.
    public function captions()
    {
        return $this->morphToMany(Locale::class, 'model', 'localables')
                    ->with(['caption', 'placeholder'])
                    ->withTimestamps();
    }
}
