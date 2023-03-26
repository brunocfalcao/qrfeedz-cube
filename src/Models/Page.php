<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    // Relationship validated.
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Relationship validated.
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
