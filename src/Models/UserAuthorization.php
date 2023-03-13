<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserAuthorization extends Pivot
{
    public $incrementing = true;

    public $table = 'authorizables';

    protected $guarded = [];

    public function clients()
    {
        return $this->morphedByMany(Client::class, 'authorizable')
                    ->withTimestamps();
    }

    public function groups()
    {
        return $this->morphedByMany(Group::class, 'authorizable')
                    ->withTimestamps();
    }

    public function questionnaires()
    {
        return $this->morphedByMany(Questionnaire::class, 'authorizable')
                    ->withTimestamps();
    }
}
