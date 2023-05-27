<?php

namespace QRFeedz\Cube\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * This is related to the table "question_widget". Although this is a
 * N-N table (between questions and widget types), we need to have it as
 * model because the id is then used as a polymorphic N-N with the
 * locales where we will then configure what caption locales will
 * be used on each widget id used in the questionnaire.
 */
class QuestionWidgetType extends Pivot
{
    public $table = 'question_widget_type';

    public $incrementing = true;

    protected $guarded = [];

    protected $casts = [
        'widget_data' => 'array',
    ];

    // Relationship validated.
    public function widgetType()
    {
        return $this->belongsTo(WidgetType::class);
    }

    // Relationship validated.
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    /**
     * For better understanding, the relationship is called "captions" and
     * not "locales".
     *
     * Relationship validated.
     */
    public function captions()
    {
        return $this->morphToMany(Locale::class, 'localables')
            ->with(['caption', 'placeholder'])
            ->withTimestamps();
    }

    // Relationship verified.
    public function conditionals()
    {
        return $this->hasMany(QuestionWidgetTypeConditional::class);
    }
}
