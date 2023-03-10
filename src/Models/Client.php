<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Database\Factories\ClientFactory;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that will be guarded.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    // Relationship validated.
    public function locales()
    {
        return $this->hasMany(Locale::class);
    }

    // Relationship validated.
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Relationship validated.
    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    // Relationship validated.
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }

    // Relationship validated.
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable')
                    ->withTimestamps();
    }

    // Relationship validated.
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')
                    ->withTimestamps();
    }

    protected static function newFactory()
    {
        return ClientFactory::new();
    }
}