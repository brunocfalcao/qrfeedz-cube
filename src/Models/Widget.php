<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Widget extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'settings' => 'array',
        'is_reportable' => 'boolean',
        'is_countable' => 'boolean',
        'is_full_page' => 'boolean',
    ];

    // Relationship validated.
    public function questions()
    {
        return $this->belongsToMany(Question::class)
                    ->using(QuestionWidget::class)
                    ->withTimestamps();
    }

    public function questionWidget()
    {
        return $this->hasMany(QuestionWidget::class);
    }

    /**
     * For better understanding, the relationship is called "captions" and
     * not "locales".
     */
    public function captions()
    {
        return $this->morphToMany(Locale::class, 'model', 'localables')
                    ->with(['caption', 'variable_type', 'variable_uuid'])
                    ->withTimestamps();
    }
}
