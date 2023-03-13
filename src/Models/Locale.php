<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locale extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Although we have a relation with the questions (where we could iterate
     * the respective clients), it's better to have a direct relation with
     * the client so when a user is managing the locales, it just manages
     * the locales from its client.
     *
     * Relationship validated.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relationship validated.
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
