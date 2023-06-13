<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Cube\Models\Pivots\QuestionWidgetType;

class WidgetInstanceConditional extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'when' => 'array',
        'then' => 'array',
    ];

    // Relationship validated.
    /*
    public function questionWidgetType()
    {
        return $this->belongsTo(QuestionWidgetType::class);
    }
    */

    // Relationship verified.
    public function captions()
    {
        return $this->morphToMany(Locale::class, 'model')
            ->with(['caption', 'placeholder'])
            ->withTimestamps();
    }
}
