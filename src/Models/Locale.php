<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locale extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // Relationship verified.
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    // Relationship validated.
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }

    // Relationship verified.
    public function questions()
    {
        return $this->morphedByMany(Question::class, 'localable')
                    ->with(['caption', 'placeholder'])
                    ->withTimestamps();
    }

    // Relationship validated.
    public function questionWidgets()
    {
        return $this->morphedByMany(QuestionWidget::class, 'localable')
                    ->with(['caption', 'placeholder'])
                    ->withTimestamps();
    }

    public function questionWidgetConditionals()
    {
        return $this->morphedByMany(QuestionWidget::class, 'localable')
                    ->with(['caption', 'placeholder'])
                    ->withTimestamps();
    }
}
