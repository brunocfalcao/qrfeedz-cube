<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use QRFeedz\Cube\Concerns\HasAutoIncrementsByGroup;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class QuestionInstance extends QRFeedzModel
{
    use HasAutoIncrementsByGroup, SoftDeletes;

    protected $casts = [
        'is_required' => 'boolean',
        'is_analytical' => 'boolean',
        'is_used_for_personal_data' => 'boolean',
    ];

    /**
     * Source: responses.id
     * Relationship: validated
     * Relationship ID: 19
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    /**
     * Source: page_instances.id
     * Relationship: validated
     * Relationship ID: 24
     */
    public function pageInstance()
    {
        return $this->belongsTo(PageInstance::class);
    }

    /**
     * Source: widget_instances.id
     * Relationship: validated
     * Relationship ID: 20
     */
    public function widgetInstances()
    {
        return $this->hasMany(WidgetInstance::class);
    }

    /**
     * Source: locales.id
     * Relationship: validated
     * Relationship ID: 15
     */
    public function captions()
    {
        return $this->morphToMany(Locale::class, 'model', 'localables')
                    ->withPivot(['caption', 'placeholder'])
                    ->withTimestamps();
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */
    public function canBeDeleted()
    {
        /**
         * A question instance cannot be delete in case there are responses
         * related with it.
         */
        return ! $this->responses()->withTrashed()->exists();
    }

    /** ---------------------- DEFAULT VALUES ------------------------------- */
    public function defaultIndexAttribute()
    {
        return $this->incrementByGroup('page_instance_id');
    }

    public function defaultUuidAttribute()
    {
        return (string) Str::uuid();
    }
}
