<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageType extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_full_screen' => 'boolean'
    ];

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class)
            ->using(PageTypeQuestionnaire::class)
            ->withPivot(['id', 'index', 'group', 'view_component_override'])
            ->withTimestamps();
    }
}
