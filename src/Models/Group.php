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
     * This is a N-N relationship.
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
