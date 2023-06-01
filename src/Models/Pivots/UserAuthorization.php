<?php

namespace QRFeedz\Cube\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserAuthorization extends Pivot
{
    public $incrementing = true;

    public $table = 'authorizables';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clients()
    {
        return $this->morphedByMany(Client::class, 'authorizable')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    public function groups()
    {
        return $this->morphedByMany(Group::class, 'authorizable')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    public function questionnaires()
    {
        return $this->morphedByMany(Questionnaire::class, 'authorizable')
            ->withPivot('user_id')
            ->withTimestamps();
    }
}