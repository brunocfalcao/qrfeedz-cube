<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpenAIPrompt extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'openai_prompts';

    protected $casts = [
        'should_be_email_aware' => 'boolean',
    ];

    // Relationship validated.
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}