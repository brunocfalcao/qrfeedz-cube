<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Page extends QRFeedzModel
{
    use SoftDeletes;

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
