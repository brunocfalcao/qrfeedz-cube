<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Database\Factories\AffiliateFactory;

class Affiliate extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Relationship validated.
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    // Relationship validated.
    public function authorizations()
    {
        return $this->morphToMany(Authorization::class, 'authorizable')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    // Relationship validated.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Factory namespace validated.
    protected static function newFactory()
    {
        return AffiliateFactory::new();
    }
}
