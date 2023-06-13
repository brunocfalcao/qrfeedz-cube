<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Response extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'values' => 'array',
    ];

    /**
     * The respective question where this response is related to.
     *
     * Source: questions.id
     * Relationship: validated
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
