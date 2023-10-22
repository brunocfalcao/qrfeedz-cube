<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Page extends QRFeedzModel
{
    use SoftDeletes;

    /**
     * Source: page_instances.id
     * Relationship: validated
     * Relationship ID: 16
     */
    public function pageInstances()
    {
        return $this->hasMany(PageInstance::class);
    }

    public function canBeDeleted()
    {
        // Nothing to compute at the moment.
        return true;
    }
}
