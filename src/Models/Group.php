<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

class Group extends QRFeedzModel
{
    use SoftDeletes;

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * A group can belong to several questionnaires, and vice-versa.
     * Groups are system-assigned, and not user-based assigned, so the
     * backoffice can be dynamically rendered and scoped.
     *
     * Source: questionnaires.id
     * Relationship: validated
     */
    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class)
                    ->withTimestamps();
    }
}
