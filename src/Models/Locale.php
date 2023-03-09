<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locale extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
