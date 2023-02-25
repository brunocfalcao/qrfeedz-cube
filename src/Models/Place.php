<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that will be guarded.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
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
}
