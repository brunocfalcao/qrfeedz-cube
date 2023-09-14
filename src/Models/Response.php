<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Response extends QRFeedzModel
{
    use SoftDeletes;

    protected $casts = [
        'value' => 'array',
    ];

    /**
     * The respective question instance where this response is related to.
     *
     * Source: question_instances.id
     * Relationship: validated
     */
    public function questionInstance()
    {
        return $this->belongsTo(QuestionInstance::class);
    }
}
