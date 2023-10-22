<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Locale extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * Source: users.id
     * Relationship: validated
     * Relationship ID: 27
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Source: clients.id
     * Relationship: validated
     * Relationship ID: 11
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * Source: questionnaires.id
     * Relationship: validated
     * Relationship ID: 14
     */
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }

    /**
     * Source: question_instances.id
     * Relationship: validated
     * Relationship ID: 15
     */
    public function questionInstances()
    {
        return $this->morphedByMany(QuestionInstance::class, 'model', 'localables')
                    ->withPivot(['caption', 'placeholder'])
                    ->withTimestamps();
    }

    /**
     * Source: question_instances.id
     * Relationship: validated
     * Relationship ID: 23
     */
    public function widgetInstances()
    {
        return $this->morphedByMany(WidgetInstance::class, 'model', 'localables')
                    ->withPivot(['caption', 'placeholder'])
                    ->withTimestamps();
    }

    public function canBeDeleted()
    {
        // Locales cannot be deleted.
        return false;
    }
}
