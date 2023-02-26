<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Cube\Models\Widget;

class Response extends Model
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
        'data' => 'array'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }
}
