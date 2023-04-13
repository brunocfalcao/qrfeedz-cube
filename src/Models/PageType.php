<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class)
                    ->using(PageTypeQuestionnaire::class)
                    ->withPivot(['index', 'group', 'view_component_override'])
                    ->withTimestamps();
    }
}
