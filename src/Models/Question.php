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

    /**
     * The related responses answered by visitors, part of the question.
     *
     * Source: responses.id
     * Relationship: validated
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function pages()
    {
    }

    /**
     * What widgets are used on this question. The intermediate table is also
     * a special model called WidgetInstance that will allow other widget
     * logic to be connected to it.
     *
     * Source: widgets.id
     * Relationship: validated
     */
    public function widgets()
    {
        return $this->belongsToMany(Widget::class)
                    ->with(['widget_index', 'widget_data'])
                    ->withTimestamps();
    }

    /**
     * A question itself has a caption, so this caption can be translated
     * in several languages. Therefore we have these captions that will
     * return all the caption locales that were created.
     *
     * Source: locales.id
     * Relationship: validated
     */
    public function captions()
    {
        return $this->morphToMany(Locale::class, 'model')
                    ->with(['caption', 'placeholder'])
                    ->withTimestamps();
    }
}
