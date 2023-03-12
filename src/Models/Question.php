<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_required' => 'boolean',
        'settings_override' => 'array',
        'caption_locales' => 'array',
        'is_caption_visible' => 'boolean',
    ];

    // Relationship validated.
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    // Relationship validated.
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    /**
     * This relation is used when we are designing a questionnaire and we need
     * to access the widgets list.
     *
     * Relationship validated.
     */
    public function widgetsForDesign()
    {
        return $this->hasOne(Widget::class, 'widget_group_uuid', 'group_uuid')
                    ->ofMany('version', 'max');
    }

    /**
     * This relation is used to know what widgets belong to a already
     * existing questionnaire instance.
     *
     * Relationship validated.
     */
    public function widgets()
    {
        return $this->belongsToMany(Widget::class);
    }

    // Relationship validated.
    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }
}
