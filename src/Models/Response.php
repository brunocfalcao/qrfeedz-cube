<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Response extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];

    // Relationship validated.
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
