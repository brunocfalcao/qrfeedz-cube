<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Cube\Models\Pivots\QuestionWidgetType;

class Locale extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * The clients default locales that are from a specific locale.
     *
     * Source: clients.id
     * Relationship: validated
     */
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
    /*
    public function questionWidgetTypes()
    {
        return $this->morphedByMany(QuestionWidgetType::class, 'localable')
            ->with(['caption', 'placeholder'])
            ->withTimestamps();
    }
    */
}
