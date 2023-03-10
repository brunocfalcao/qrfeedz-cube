<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    // Relationship validated.
    public function clients()
    {
        return $this->morphedByMany(Client::class, 'categorizable');
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
