<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that will be guarded.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $casts = [
        'is_required' => 'boolean',
        'settings_override' => 'array',
        'caption_locales' => 'array'
    ];

    /**
     * Indeed a question could have belonged to several questionnaires so we
     * could optimize a question with a questionnaire. Still, for the sake
     * of data organization and simplicity to understand, I prefer to have
     * a 1-N relationship with a questionnaire and not a N-N.
     * In practise, it means that the same question will be repeated if we
     * create a new questionnaire to be used on different places but under
     * the same organization.
     */
    public function questionnaires()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }

    public function locales()
    {
        return $this->hasMany(Locale::class);
    }

    public function childQuestions()
    {
        return $this->belongsToMany(Question::class, 'question_flows', 'question_id_parent', 'question_id_child');
    }

    public function parentQuestions()
    {
        return $this->belongsToMany(Question::class, 'question_flows', 'question_id_child', 'question_id_parent');
    }
}
