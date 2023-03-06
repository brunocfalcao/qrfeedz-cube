<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Database\Factories\PlaceFactory;

class Place extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class)
                    ->withTimestamps();
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable')
                    ->withTimestamps();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')
                    ->withTimestamps();
    }

    public function defaultLocalityAttribute()
    {
        if (! blank($this->organization_id)) {
            return Organization::firstWhere(
                'id',
                $this->organization_id
            )->locality;
        }
    }

    public function defaultPostalCodeAttribute()
    {
        if (! blank($this->organization_id)) {
            return Organization::firstWhere(
                'id',
                $this->organization_id
            )->postal_code;
        }
    }

    public function defaultNameAttribute()
    {
        if (! blank($this->organization_id)) {
            return Organization::firstWhere(
                'id',
                $this->organization_id
            )->address;
        }
    }

    public function defaultAddressAttribute()
    {
        if (! blank($this->organization_id)) {
            return Organization::firstWhere(
                'id',
                $this->organization_id
            )->address;
        }
    }

    public function defaultCountryIdAttribute()
    {
        if (! blank($this->organization_id)) {
            return Organization::firstWhere(
                'id',
                $this->organization_id
            )->country->id;
        }
    }

    protected static function newFactory()
    {
        return PlaceFactory::new();
    }
}
