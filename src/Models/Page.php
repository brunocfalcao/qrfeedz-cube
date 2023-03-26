<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Cube\Concerns\HasAutoIncrementsByGroup;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasAutoIncrementsByGroup;

    protected $guarded = [];

    public function pageType()
    {
        return $this->belongsTo(PageType::class);
    }

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
