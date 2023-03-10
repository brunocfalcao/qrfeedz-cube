<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Widget extends Model
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
        'settings' => 'array',
        'is_reportable' => 'boolean',
    ];

    /**
     * This relation is used only to know what question ids where answered
     * specifically by this widget id. It doesn't take in account any
     * versioning for the group_uuids.
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    // Relationship valiated.
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function scopeNewestByCanonical(Builder $query, string $canonical)
    {
        return $this->where('canonical', $canonical)
                    ->orderBy('version', 'desc')
                    ->first();
    }
}
