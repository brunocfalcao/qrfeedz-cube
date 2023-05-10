<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use QRFeedz\Services\ThemeColor;

class Questionnaire extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',

        'is_active' => 'boolean',
        'has_splash_screenscreen' => 'boolean',
        'has_select_language_screen' => 'boolean',
    ];

    // Relationship validated.
    public function OpenAIPromptConfigurations()
    {
        return $this->hasOne(OpenAIPromptConfiguration::class);
    }

    // Relationship validated.
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relationship validated.
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    // Relationship validated.
    public function authorizations()
    {
        return $this->morphToMany(Authorization::class, 'authorizables')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    // Relationship validated.
    public function authorizationsForUser(User $user)
    {
        return $this->morphToMany(Authorization::class, 'authorizables')
            ->withPivot('user_id')
            ->wherePivot('user_id', $user->id)
            ->withTimestamps();
    }

    /**
     * Special relationship that will return the authorizations for a logged
     * user. Used to simplify the query of getting what authorizations does
     * the logged user has respective to questionnaire authorizations.
     */
    public function loggedUserAuthorizations()
    {
        return $this->morphToMany(Authorization::class, 'authorizables')
            ->withPivot('user_id')
            ->wherePivot('user_id', Auth::id())
            ->withTimestamps();
    }

    /**
     * The different question-widget instances that will be part of this
     * questionnaire. They are unique for this questionnaire and cannot
     * be replicated to other questionnaires from the same client.
     *
     * Relationship validated.
     */
    public function questionWidgetTypes()
    {
        return $this->hasMany(QuestionWidgetType::class);
    }

    // Relationship validated.
    public function pageTypes()
    {
        return $this->belongsToMany(PageType::class)
            ->using(PageTypeQuestionnaire::class)
            ->withPivot(['id', 'index', 'group', 'view_component_override'])
            ->orderBy('index')
            ->withTimestamps();
    }

    // Relationship validated.
    public function categories()
    {
        return $this->morphToMany(Category::class, 'model', 'categorizables')
            ->withTimestamps();
    }

    // Relationship validated.
    public function openAIPrompt()
    {
        return $this->hasOne(OpenAIPrompt::class);
    }

    // Relationship validated.
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'model', 'taggables')
            ->withTimestamps();
    }

    // Relationship validated.
    public function locale()
    {
        return $this->belongsTo(Locale::class);
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

        return $colors['primary'];
    }

    public function defaultColorSecondaryAttribute()
    {
        $colors = ThemeColor::make($this->color_primary)->compute();

        return $colors['complementary'];
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */

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
}
