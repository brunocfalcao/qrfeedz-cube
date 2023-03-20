<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Questionnaire extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
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
        return $this->morphToMany(Authorization::class, 'model', 'authorizables')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    // Relationship validated.
    public function authorizationsForUser(User $user)
    {
        return $this->morphToMany(Authorization::class, 'model', 'authorizables')
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
        return $this->morphToMany(Authorization::class, 'model', 'authorizables')
                    ->withPivot('user_id')
                    ->wherePivot('user_id', Auth::id())
                    ->withTimestamps();
    }

    public function questionWidget()
    {
        return $this->hasMany(QuestionWidget::class);
    }

    // Relationship validated.
    public function questions()
    {
        return $this->hasMany(Question::class);
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

    // Fallback to client locale, or to english.
    public function defaultLocaleIdAttribute()
    {
        if ($this->client) {
            return $this->client->locale_id;
        } else {
            return Locale::firstWhere('code', 'en')->id;
        }
    }

    // Returns a default uuid(), in case no uuid is present.
    public function defaultUuidAttribute()
    {
        return (string) Str::uuid();
    }
}
