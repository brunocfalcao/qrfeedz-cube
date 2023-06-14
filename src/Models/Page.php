<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Related page instances that have a respective page id.
     *
     * Source: page_instances.id
     * Relationship: validated
     */
    public function pageInstances()
    {
        return $this->hasMany(PageInstance::class)
                    ->withTimestamps();
    }
}
