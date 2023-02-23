<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use QRFeedz\Cube\Models\Place;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that will be guarded.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function organizations()
    {
        return $this->morphedByMany(Organization::class, 'categorizable');
    }

    public function places()
    {
        return $this->morphedByMany(Place::class, 'categorizable');
    }

    public function questionnaires()
    {
        return $this->morphedByMany(Questionnaire::class, 'categorizable');
    }
}
