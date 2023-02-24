<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use QRFeedz\Database\Factories\OrganizationFactory;

class Organization extends Model
{
    use HasFactory;

    /**
     * The attributes that will be guarded.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class);
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
        return OrganizationFactory::new();
    }
}
