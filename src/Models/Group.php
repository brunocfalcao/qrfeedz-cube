<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Database\Factories\GroupFactory;

class Group extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class)
                    ->withTimestamps();
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

    protected static function newFactory()
    {
        return GroupFactory::new();
    }
}
