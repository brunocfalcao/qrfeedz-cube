<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Authorization extends Model
{
    use SoftDeletes;

    /**
     * The attributes that will be guarded.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function clients()
    {
        return $this->morphedByMany(Client::class, 'authorizable')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }
}
