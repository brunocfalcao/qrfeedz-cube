<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionWidgetConditional extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'when' => 'array',
        'then' => 'array',
    ];

    // Relationship validated.
    public function questionWidget()
    {
        return $this->belongsTo(QuestionWidget::class);
    }
}
