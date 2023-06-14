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

    /**
     * The questionnaire default locale. Basically, it will be the locale
     * that information will be shown when there is no locale specified
     * on the questionnaire context.
     *
     * Source: questionnaires.id
     * Relationship: validated
     */
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }

    /**
     * All the question instances that have a specific locale id. Still, it's not
     * at all useful since the morphed models would actually have the
     * right caption to show.
     *
     * Source: question_instances.id
     * Relationship: validated
     */
    public function questionInstances()
    {
        return $this->morphedByMany(QuestionInstance::class, 'model')
                    ->with(['caption', 'placeholder'])
                    ->withTimestamps();
    }

    /**
     * All the question instances that have a specific locale id. Still, it's not
     * at all useful since the morphed models would actually have the
     * right caption to show.
     *
     * Source: question_instances.id
     * Relationship: validated
     */
    public function widgetInstances()
    {
        return $this->morphedByMany(WidgetInstance::class, 'model')
                    ->with(['caption', 'placeholder'])
                    ->withTimestamps();
    }
}
