<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that will be guarded.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function clients()
    {
        return $this->morphedByMany(Client::class, 'categorizable');
    }

    public function groups()
    {
        return $this->morphedByMany(Group::class, 'categorizable');
    }

    public function questionnaires()
    {
        return $this->morphedByMany(Questionnaire::class, 'categorizable');
    }
}
