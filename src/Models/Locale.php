<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locale extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }

    public function questions()
    {
        return $this->morphedByMany(Question::class, 'localable');
    }

    public function questionWidgets()
    {
        return $this->morphedByMany(QuestionWidget::class, 'localable');
    }
}
