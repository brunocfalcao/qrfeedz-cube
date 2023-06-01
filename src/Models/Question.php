<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Cube\Concerns\HasAutoIncrementsByGroup;
use QRFeedz\Cube\Models\Pivots\PageTypeQuestionnaire;

class Question extends Model
{
    use HasAutoIncrementsByGroup;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_required' => 'boolean',
        'is_analytical' => 'boolean',
        'is_single_value' => 'boolean',
        'is_used_for_personal_data' => 'boolean',
    ];

    // Relationship validated.
    /*
    public function pageTypeQuestionnaire()
    {
        return $this->belongsTo(PageTypeQuestionnaire::class);
    }
    */

    // Relationship validated.
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    // Relationship validated.
    public function widgetTypes()
    {
        return $this->belongsToMany(Widget::class)
            ->with(['id', 'widget_index', 'widget_data'])
            ->withTimestamps();
    }

    /**
     * For better understanding, the relationship is called "captions" and
     * not "locales".
     *
     * Relationship verified.
     */
    public function captions()
    {
        return $this->morphToMany(Locale::class, 'localables')
            ->with(['caption', 'placeholder'])
            ->withTimestamps();
    }
}
