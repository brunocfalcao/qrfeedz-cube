<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpenAIPromptConfiguration extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'openai_prompt_configurations';

    // Relationship validated.
    public function questionnaires()
    {
        return $this->hasMany(Client::class);
    }
}
