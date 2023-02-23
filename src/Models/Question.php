<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that will be guarded.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
}
