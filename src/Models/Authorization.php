<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Authorization extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function clients()
    {
        return $this->morphedByMany(Client::class, 'authorizable')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    public function questionnaires()
    {
        return $this->morphedByMany(Questionnaire::class, 'authorizable')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    public function groups()
    {
        return $this->morphedByMany(Group::class, 'authorizable')
            ->withPivot('user_id')
            ->withTimestamps();
    }
}
