<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function pageInstances()
    {
        return $this->hasMany(PageInstance::class)
                    ->withTimestamps();
    }
}
