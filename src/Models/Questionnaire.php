<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    /**
     * The attributes that will be guarded.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function places()
    {
        return $this->belongsToMany(Place::class)
                    ->withTimestamps();
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable')
                    ->withTimestamps();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')
                    ->withTimestamps();
    }
}
