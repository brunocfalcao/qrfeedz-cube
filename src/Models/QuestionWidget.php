<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This is related to the table "question_widget". Although this is a
 * N-N table (between questions and widgets), we need to have it as
 * model because the id is then used as a polymorphic N-N with the
 * locales where we will then configure what caption locales will
 * be used on each widget id used in the questionnaire.
 */
class QuestionWidget extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'settings_data' => 'array',
        'settings_conditionals' => 'array',
    ];

    // Relationship validated.
    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }

    // Relationship validated.
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    /**
     * For better understanding, the relationship is called "captions" and
     * not "locales".
     */
    public function captions()
    {
        return $this->morphToMany(Locale::class, 'localable')
                    ->with(['caption', 'variable'])
                    ->withTimestamps();
    }
}
