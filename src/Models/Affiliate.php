<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affiliate extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // Relationship validated.
    public function authorizations()
    {
        return $this->morphToMany(Authorization::class, 'model', 'authorizable')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    // Relationship validated.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
