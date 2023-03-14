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
        'is_analytical' => 'boolean',
        'is_single_value' => 'boolean',
        'is_used_for_personal_data' => 'boolean',
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

    // Relationship validated.
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
