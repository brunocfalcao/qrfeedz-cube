<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class OpenAIPrompt extends QRFeedzModel
{
    use SoftDeletes;

    protected $table = 'openai_prompts';

    protected $casts = [
        'should_be_email_aware' => 'boolean',
    ];

    /**
     * Source: questionnaires.id
     * Relationship: validated
     * Relationship ID: 18
     */
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
