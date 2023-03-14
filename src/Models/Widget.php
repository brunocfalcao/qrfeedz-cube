<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Widget extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'settings' => 'array',
        'is_reportable' => 'boolean',
    ];

    // Relationship validated.
    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function questionWidget()
    {
        return $this->hasMany(QuestionWidget::class);
    }
}
