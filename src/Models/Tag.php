<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Tags that are related with clients. The client tags are reserved only
     * for super admin management.
     *
     * Source: clients.id
     * Relationship: validated
     */
    public function clients()
    {
        return $this->belongsToMany(Client::class)
                    ->withTimestamps();
    }

    // Relationship validated.
    public function groups()
    {
        return $this->morphedByMany(Group::class, 'categorizable');
    }

    // Relationship validated.
    public function questionnaires()
    {
        return $this->morphedByMany(Questionnaire::class, 'categorizable');
    }
}
