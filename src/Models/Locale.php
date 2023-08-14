<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Locale extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * The user default locales that are from a specific locale.
     *
     * Source: users.id
     * Relationship: validated
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

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
        return $this->morphedByMany(QuestionInstance::class, 'model', 'localables')
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
        return $this->morphedByMany(WidgetInstance::class, 'model', 'localables')
                    ->with(['caption', 'placeholder'])
                    ->withTimestamps();
    }

    /**
     * The conditional message locales that needed to be specified.
     *
     * Source: widget_instance_conditionals
     * Relationship: validated
     */
    public function widgetInstanceConditionals()
    {
        return $this->morphedByMany(WidgetInstanceConditional::class, 'model', 'localables')
                    ->with(['caption', 'placeholder'])
                    ->withTimestamps();
    }
}
