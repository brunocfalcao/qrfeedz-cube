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
     * Each questionnaire should have an AI prompt to optimize the feedback
     * conclusions to the questionnaire owner.
     *
     * Source: questionnaires.id
     * Relationship: validated
     */
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
