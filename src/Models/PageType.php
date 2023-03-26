<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
