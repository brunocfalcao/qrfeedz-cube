<?php

namespace QRFeedz\Cube\Models;

use Brunocfalcao\Cerebrus\Cerebrus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;
use QRFeedz\Services\ThemeColor;

/**
 * The questionnaire is a crucial entity that enables the gathering of
 * feedback about a client's interest in a location. Typically,
 * questionnaires are associated with physical locations such
 * as restaurants or stores, but they can also be related to
 * specific items like hotel rooms or specific areas within
 * a store.
 */
class Questionnaire extends QRFeedzModel
{
    use SoftDeletes;

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',

        'is_active' => 'boolean',
        'has_splash_screen' => 'boolean',

        'data' => 'array',
    ];

    /**
     * The questionnaire will belong to a system-assigned category. This allows
     * the backoffice to dynamically generate reports based on the category
     * itself. E.g.: A restaurant questionnaire will not have the same display
     * in the backoffice as a product questionnaire.
     *
     * Source: category.id
     * Relationship: validated
     * Relationship ID: 6
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Source: question_instances.id
     * Relationship: validated
     * Relationship ID: 24
     */
    public function questionInstances()
    {
        return $this->hasMany(QuestionInstance::class);
    }

    /**
     * Source: location.id
     * Relationship: validated
     * Relationship ID: 26
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Source: openai_prompts.id
     * Relationship: validated
     * Relationship ID: 18
     */
    public function openAIPrompt()
    {
        return $this->hasOne(OpenAIPrompt::class);
    }

    /**
     * Source: tags.id
     * Relationship: validated
     * Relationship ID: 13
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    /**
     * Source: locales.id
     * Relationship: validated
     * Relationship ID: 14
     */
    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }

    /**
     * Source: questionnaire_authorizations.questionnaire_id
     * Relationship: validated
     * Relationship ID: 31
     */
    public function authorizations()
    {
        return $this->hasMany(QuestionnaireAuthorization::class);
    }

    /** ---------------------- DEFAULT VALUES ------------------------------- */

    // Fallback to client locale, or to english.
    public function defaultLocaleIdAttribute()
    {
        if ($this->client) {
            return $this->client->locale_id;
        } else {
            return Locale::firstWhere('canonical', 'en')->id;
        }
    }

    // Returns a default uuid(), in case no uuid is present.
    public function defaultUuidAttribute()
    {
        return (string) Str::uuid();
    }

    // Color defaults.
    public function defaultColorPrimaryAttribute()
    {
        $colors = ThemeColor::make()->compute();

        return '#'.$colors['primary'];
    }

    public function defaultColorSecondaryAttribute()
    {
        $colors = ThemeColor::make($this->color_primary)->compute();

        return '#'.$colors['complementary'];
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */
    public function canBeDeleted()
    {
        // Cannot delete questionnaires with responses already.
        return ! $this->whereHas('questionInstances.responses', function (Builder $builder) {
            return $this->withTrashed();
        })->exists();
    }

    /**
     * A questionnaire is valid if:
     * - is_active is true and
     * - now() is after starts_at and (if exists) now() is before ends_at.
     */
    public function isValid()
    {
        return
            $this->is_active &&
            $this->ends_at ? now()->between($this->starts_at, $this->ends_at) :
                             now() >= $this->starts_at;
    }

    public static function fromSession()
    {
        $session = new Cerebrus();

        return $session->has('questionnaire') ?
                $session->get('questionnaire') :
                null;
    }
}
