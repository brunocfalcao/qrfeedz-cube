<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class)
            ->withPivot(['id', 'index', 'group', 'view_component_override'])
            ->withTimestamps();
    }
}
